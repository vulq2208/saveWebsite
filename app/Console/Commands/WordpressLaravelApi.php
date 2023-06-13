<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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

    public function wordpressApiLaravel()
    {

        $postID = DB::connection('wordpress')
            ->table('posts')
            ->orderBy('post_date', 'desc')
            ->first();

        DB::connection('wordpress')->table('posts')->insert([
            'ID' => $postID->ID,
            'post_author' => 2,
            'post_date' => now(),
            'post_date_gmt' => now(),
            'post_content' => '<!-- wp:paragraph -->
                <p><a href="https://vnexpress.net/cuu-tu-lenh-canh-sat-bien-bi-cao-buoc-rut-ruot-50-ty-dong-the-nao-4565567.html">Ông Nguyễn Văn Sơn, cựu trung tướng, cựu Tư lệnh cảnh sát biển, bị cáo buộc khi đương chức đã chỉ đạo "rút ruột" 50 tỷ đồng từ ngân sách mua thiết bị để ăn chia với 4 cán bộ dưới quyền.</a></p>
                <!-- /wp:paragraph -->',
            'post_title' => 'Custom Styles',
            'post_excerpt' => 123,
            'post_status' => 'publish',
            'comment_status' => 'open',
            'ping_status' => 'open',
            'post_password' => "",
            'post_name' => 'cuu-tu-lenh-canh-sat-bien-bi-cao-buoc-rut-ruot-50-ty-dong-the-nao',
            'to_ping' => 123,
            'pinged' => 123,
            'post_modified' => now(),
            'post_modified_gmt' => now(),
            'post_content_filtered' => 123,
            'post_parent' => 0,
            'guid' => 123,
            'menu_order' => 0,
            'post_type' => 'post',
            'post_mime_type' => 123,
            'comment_count' => 0,
        ]);

    }

    public function createCategoryWordpress()
    {

        $dataCategory = Category::find(62);
        $postID = DB::connection('wordpress')
            ->table('terms')
            ->orderBy('term_id', 'desc')
            ->first();

        DB::connection('wordpress')->table('terms')->insert([
            'term_id' => $postID->term_id + 1,
            'name' => $dataCategory->name,
            'slug' => $dataCategory->slug,
            'term_group' => 0,
        ]);

    }

    public function createCategoriesWordpress()
    {

        $dataCategory = Category::get();
        $lastTermId = DB::connection('wordpress')
            ->table('terms')
            ->max('term_id');

        foreach ($dataCategory as $category) {
            $slugExists = DB::connection('wordpress')
                ->table('terms')
                ->where('slug', $category->slug)
                ->exists();

            if (!$slugExists) {
                $newTermId = $lastTermId + 1;

                DB::connection('wordpress')->table('terms')->insert([
                    'term_id' => $newTermId,
                    'name' => $category->name,
                    'slug' => $category->slug,
                    'term_group' => 0,
                ]);

                $lastTermId = $newTermId;
            }
        }

    }
    public function handle()
    {

        // $this->wordpressApiLaravel();

        $this->createCategoriesWordpress();

    }
}
