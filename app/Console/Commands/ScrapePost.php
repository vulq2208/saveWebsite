<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Goutte\Client;

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

     public function myFunction() {
        $client = new Client();
        $crawler = $client->request('GET', 'https://vnexpress.net/man-utd-vs-newcastle-4575086-tong-thuat.html');
        $imageUrls = $crawler->filter('picture img')->first()->attr('data-src');
        $title = $crawler->filter('.title-detail')->text();
        $content = $crawler->filter('.Normal')->first()->text();

        $create = DB::table('save_websites')->insert([

            'title' => $title,
            'content' => $content,
            'picture' => $imageUrls,
            'created_at' => now(),
            'updated_at' => now()

        ]);

       if($create) {
        $this->info('Lấy dữ liệu thành công!');
       }
    }

    public function handle()
    {
        $this->myFunction();
    }

}
