<?php

namespace App\Console\Commands;

use Goutte\Client;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\CategoryPost;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ExtractCategoryPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Extract:CategoryPost';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /*
    *  Author : Sap
    *  Date Create : 24/03/2023
    *  Description : Create Category
    *  Parameter :
    *  Return : create Category, $categoryIds
    */
    public function extractCategory()
    {

        $client = new Client();
        $crawler = $client->request('GET', 'https://people.com/parents/hoda-kotb-absent-from-today-as-she-spends-spring-break-with-daughters-after-hope-health-scare/');

        $getURl = $crawler->filter('.mntl-breadcrumbs .mntl-breadcrumbs__item')->each(function ($node) use ($client , $crawler) {
            return  $node->filter('a')->attr('href');
        });

        $categoryIds = array();

        for ($i = 0; $i < count($getURl); $i++) {
            $url = $getURl[$i];
            $lastUrl = end($getURl);
            $crawler = $client->request('GET', $url);
            $dataName = $crawler->filter('.mntl-taxonomysc-header-group h1')->text();
            $slug = Str::slug($dataName);

            $newCategory = Category::updateOrCreate(['slug' => $slug], [
                'parent_id' => ($i == 0) ? null : $category[$i - 1]->id,
                'name' => $dataName,
                'slug' => $slug,
                'order' => 123,
            ]);

            $crawlerLast = $client->request('GET',$lastUrl);
            $urlPosts = $crawlerLast->filter('.card--no-image')->each(function ($node) use ($client) {
                return  $node->attr('href');
            });

            $category[] = $newCategory;
            $categoryIds[] = $newCategory->id;

        }

        for($i = 0 ; $i < count($urlPosts); $i++) {
            $urlPost = $urlPosts[$i];
            $crawler = $client->request('GET', $urlPost);
            $title = $crawler->filter(' .people-article .article-header h1')->text();
            $slug = Str::slug($title);
            $currentUrl = $client->getHistory()->current()->getUri();
                $body =  $crawler->filter('.structured-content p')->each(function ($node){
                    return $node->text();
                });
                $stringBody = implode(", ", $body);
                $imageUrl = $crawler->filter('img')->first()->attr('src');
                $slugImage = Str::slug(pathinfo($imageUrl, PATHINFO_FILENAME));
                $file_name = $slugImage . '.' . pathinfo($imageUrl, PATHINFO_EXTENSION);
                if (!Storage::exists('images/' . $file_name)) {
                    $imageContent = file_get_contents($imageUrl);
                    Storage::put('images/' . $file_name, $imageContent);
                }

                $post = Post::where('slug', $slug)->updateOrCreate([
                    'author_id' => 1,
                    'category_id'=> null,
                    'title'    => $title,
                    'body'   => $stringBody,
                    'image' => $file_name,
                    'slug' => $slug,
                    'status' => 1,
                    'featured'=> 0,
                    'source' => $currentUrl,
                ]);

                $postId = $post->id;

                foreach ($categoryIds as $categoryId) {
                    $exist = CategoryPost::where('category_id', $categoryId)->where('post_id', $postId)->first();
                    if (!$exist) {
                        CategoryPost::updateOrCreate([
                            'category_id' => $categoryId,
                            'post_id' => $postId,
                        ]);
                    }
                }
        }

        return $categoryIds;

    }
    /*
    *  Author : Sap
    *  Date Create : 27/03/2023
    *  Description : Create Post
    *  Parameter :
    *  Return : create Post, create CategoryPost
    */
    public function extractPost()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://people.com/parents/hoda-kotb-absent-from-today-as-she-spends-spring-break-with-daughters-after-hope-health-scare/');
        $title = $crawler->filter(' .people-article .article-header h1')->text();

        $body =  $crawler->filter('.structured-content p')->each(function ($node){
            return $node->text();
        });
        $slug = Str::slug($title);
        $currentUrl = $client->getHistory()->current()->getUri();
        $stringBody = implode(", ", $body);
        $imageUrl = $crawler->filter('.primary-image__media img')->first()->attr('src');
        $slugImage = Str::slug(pathinfo($imageUrl, PATHINFO_FILENAME));
        $file_name = $slugImage . '.' . pathinfo($imageUrl, PATHINFO_EXTENSION);
        if (!Storage::exists('images/' . $file_name)) {
            $imageContent = file_get_contents($imageUrl);
            Storage::put('images/' . $file_name, $imageContent);
        }
        $post = Post::where('slug', $slug)->updateOrCreate([
            'author_id' => 1,
            'category_id'=> null,
            'title'    => $title,
            'body'   => $stringBody,
            'image' => $file_name,
            'slug' => $slug,
            'status' => 1,
            'featured'=> 0,
            'source' => $currentUrl,
        ]);

        $postId = $post->id;

        $categoryIds = $this->extractCategory();
        foreach ($categoryIds as $categoryId) {
            $exist = CategoryPost::where('category_id', $categoryId)->where('post_id', $postId)->first();
            if (!$exist) {
                CategoryPost::create([
                    'category_id' => $categoryId,
                    'post_id' => $postId,
                ]);
            }
        }
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->extractPost();
    }
}
