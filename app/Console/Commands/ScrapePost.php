<?php

namespace App\Console\Commands;


use DB;
use Goutte\Client;
use Illuminate\Http\File;
use App\Models\SaveWebsite;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ScrapePost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:post';

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

     public function takeData() {


        $client = new Client();
        $crawler = $client->request('GET', 'https://vnexpress.net/man-utd-vs-newcastle-4575086-tong-thuat.html');
        $imageUrls = $crawler->filter('picture img')->first()->attr('data-src');
        $title = $crawler->filter('.title-detail')->text();
        $content = $crawler->filter('.Normal')->first()->text();


        //Save Image
        $imageContent = file_get_contents($imageUrls);
        $randomImageName = Str::random(10) . '.jpg';
        $storedImage = Storage::put('images/'.$randomImageName,$imageContent);



        // //Create Data
       $createData =  SaveWebsite::create([
            'title' => $title,
            'content' => $content,
            'picture' => $randomImageName,
            'created_at' => now(),
            'updated_at' => now()
        ]);

       if($createData) {
        $this->info('Lấy dữ liệu thành công!');
       }
    }

    public function handle()
    {
        $this->takeData();
    }

}
