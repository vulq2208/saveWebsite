<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Goutte\Client;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;

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
    *  Date Create : 24/03
    *  Description : Create Category
    *  Parameter :url, slug, name, parent_id, order
    *  Return : create Category, lastCategoryId
    */
    public function extractCategory()
    {

        $client = new Client();
        $crawler = $client->request('GET', 'https://people.com/parents/hoda-kotb-absent-from-today-as-she-spends-spring-break-with-daughters-after-hope-health-scare/');

        $getURl = $crawler->filter('.mntl-breadcrumbs .mntl-breadcrumbs__item ')->each(function ($node) use ($client , $crawler) {
            return  $node->filter('a')->attr('href');
        });

        $category = array();

        for ($i = 0; $i < count($getURl); $i++) {
            $url = $getURl[$i];
            $crawler = $client->request('GET', $url);
            $dataName = $crawler->filter('.mntl-taxonomysc-header-group h1')->text();
            $slug = Str::slug($dataName);

            $existCategory = Category::where('slug', $slug)->first();

            if(!$existCategory) {
                $newCategory = new Category;
                $newCategory->parent_id = ($i == 0) ? null : $category[$i - 1]->id;
                $newCategory->name = $dataName;
                $newCategory->slug = $slug;
                $newCategory->order = 123;
                $newCategory->save();
                $category[] = $newCategory;
            } else {
                $existCategory->parent_id = ($i == 0) ? null : $category[$i - 1]->id;
                $existCategory->name = $dataName;
                $existCategory->order = 123;
                $existCategory->save();
                $category[] = $existCategory;


            }
        }
        $lastCategoryIndex = count($category) - 1;
        $lastCategoryId = $category[$lastCategoryIndex]->id;

        return $lastCategoryId;

    }
    /*
    *  Author : Sap
    *  Date Create : 27/03
    *  Description : Create Post
    *  Parameter :slug, currentUrl, stringBody, file_name, categoryLast
    *  Return : create Post
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
        $categoryLast = $this->extractCategory();
        if (!Storage::exists('images/' . $file_name)) {
            $imageContent = file_get_contents($imageUrl);
            Storage::put('images/' . $file_name, $imageContent);
        }
        Post::create([

            'author_id' => 1,
            'category_id'=> $categoryLast,
            'title'    => $title,
            'body'   => $stringBody,
            'image' => $file_name,
            'slug' => $slug,
            'status' => 1,
            'featured'=> 0,
            'source' => $currentUrl,
        ]);
    }
    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->extractCategory();
        $this->extractPost();
    }
}
