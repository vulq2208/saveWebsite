<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Goutte\Client;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;



class SiteCategoryPost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'site:CategoryPost';

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

    /**
     * Execute the console command.
     *
     * @return int
     */


    /*
    Category
    */
    public function siteCategory()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://people.com/parents/hoda-kotb-absent-from-today-as-she-spends-spring-break-with-daughters-after-hope-health-scare/');

        $getData = $crawler->filter('.mntl-breadcrumbs ')->each(function ($node) use ($client , $crawler) {

        $linkOne = $node->filter('.mntl-breadcrumbs__item a')->first()->attr('href');
        $crawlerOne = $client->request('GET', $linkOne);
        $urlOne = $crawlerOne->getUri();
        $slugOne = basename(parse_url($urlOne, PHP_URL_PATH));
        $dataNameOne = $crawlerOne->filter('.mntl-taxonomysc-header-group h1')->text();

        $linkTwo = $node->filter('.mntl-breadcrumbs__item a')->last()->attr('href');
        $crawlerTwo = $client->request('GET', $linkTwo);
        $urlTwo = $crawlerTwo->getUri();
        $SlugTwo = basename(parse_url($urlTwo, PHP_URL_PATH));
        $dataNameTwo = $crawlerTwo->filter('.mntl-taxonomysc-header-group h1')->text();

        $firstData = Category::create([
            'parent_id' => Null,
            'name' => $dataNameOne,
            'slug' => $slugOne,
            'order' => 123,
        ]);

        $secondData  = Category::create([
            'parent_id'=> $firstData->id,
            'name' => $dataNameTwo,
            'slug' => $SlugTwo,
            'order' => 123,
        ]);
    });


    }

    /*
    Post
    */
    public function sitePost()
    {
        $client = new Client();
        $crawler = $client->request('GET', 'https://people.com/parents/hoda-kotb-absent-from-today-as-she-spends-spring-break-with-daughters-after-hope-health-scare/');
        $title = $crawler->filter(' .people-article .article-header h1')->text();
        $excerpt =  $crawler->filter('.structured-content p')->each(function ($node){
            return $node->text();
        });
        $stringExcerpt = implode(", ", $excerpt);
        $imageUrl = $crawler->filter('.primary-image__media img')->first()->attr('src');
        $imageContent = file_get_contents($imageUrl);
        $img = Str::random(10) . '.jpg';
        $storedImage = Storage::put('images/'.$img,$imageContent);
        $url = $crawler->getUri();
        $slug = basename(parse_url($url, PHP_URL_PATH));

        $lastCategory = Category::latest('id')->value('id');

        Post::create([

            'author_id' => 1,
            'category_id'=> $lastCategory,
            'title'    => $title,
            'excerpt' => $stringExcerpt,
            'body'   => 'ABC',
            'image' => $img,
            'slug' => $slug,
            'status' => 1,
            'featured'=> 0,
        ]);
    }
    public function handle()
    {
        $this->siteCategory();
        $this->sitePost();
    }
}
