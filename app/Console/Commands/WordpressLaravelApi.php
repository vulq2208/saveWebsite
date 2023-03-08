<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\Option;
use App\Models\UserMeta;


class WordpressLaravelApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:wordpressAPI';

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

    public function wordpressApiLaravel () {

        $postID = Post::latest()->first()->ID;

        $createPost = Post::create([
            'ID' => $postID + 1,
            'post_author' => 2,
            'post_date' => now(),
            'post_date_gmt' => now(),
            'post_content' =>'<!-- wp:paragraph -->
            <p><a href="https://vnexpress.net/cuu-tu-lenh-canh-sat-bien-bi-cao-buoc-rut-ruot-50-ty-dong-the-nao-4565567.html">Ông Nguyễn Văn Sơn, cựu trung tướng, cựu Tư lệnh cảnh sát biển, bị cáo buộc khi đương chức đã chỉ đạo "rút ruột" 50 tỷ đồng từ ngân sách mua thiết bị để ăn chia với 4 cán bộ dưới quyền.</a></p>
            <!-- /wp:paragraph -->',
            'post_title' => 'Custom Styles',
            'post_excerpt' => 123,
            'post_status' => 'publish',
            'comment_status' => 'open',
            'ping_status'    => 'open',
            'post_password' => null,
            'post_name' => 'cuu-tu-lenh-canh-sat-bien-bi-cao-buoc-rut-ruot-50-ty-dong-the-nao',
            'to_ping' =>  123,
            'pinged' => 123,
            'post_modified' => now(),
            'post_modified_gmt' => now(),
            'post_content_filtered' => 123,
            'post_parent' => 0,
            'guid' => 123,
            'menu_order' => 0,
            'post_type' => 'post',
            'post_mime_type' =>  123,
            'comment_count' => 0,
        ]);



    }
    public function handle()
    {

        $this->wordpressApiLaravel();

    }
}
