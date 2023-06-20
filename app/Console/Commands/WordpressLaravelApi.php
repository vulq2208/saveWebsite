<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\PostWordpress;
use Corcel\Model\Taxonomy;
use Corcel\Model\Term;
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
        $latestTerm = Term::orderBy('term_id', 'desc')->first();

        $newTerm = new Term();
        $newTerm->term_id = $latestTerm->term_id + 1;
        $newTerm->name = $dataCategory->name;
        $newTerm->slug = $dataCategory->slug;
        $newTerm->term_group = 0;
        $newTerm->save();

    }

    public function createCategoriesWordpress()
    {
        $dataCategory = Category::get();

        foreach ($dataCategory as $category) {
            $slugExists = Term::where('slug', $category->slug)->exists();

            if (!$slugExists) {
                $newTerm = new Term();
                $newTerm->name = $category->name;
                $newTerm->slug = $category->slug;
                $newTerm->term_group = 0;
                $newTerm->save();

                if ($newTerm->exists) {
                    $termTaxonomyExists = Taxonomy::where('term_id', $newTerm->term_id)->exists();

                    if (!$termTaxonomyExists) {
                        $newTermTaxonomy = new Taxonomy();
                        $newTermTaxonomy->term_id = $newTerm->term_id;
                        $newTermTaxonomy->taxonomy = 'category';
                        $newTermTaxonomy->description = '';
                        $newTermTaxonomy->parent = 0;
                        $newTermTaxonomy->count = 0;
                        $newTermTaxonomy->save();

                    }
                }

                $posts = $category->posts()->get();

                foreach ($posts as $post) {
                    $existingPost = PostWordpress::where('post_name', $post->slug)->first();
                    if (!$existingPost) {
                        $postWordpress = new PostWordpress;
                        $postWordpress->post_title = $post->title;
                        $postWordpress->post_content = $post->body;
                        $postWordpress->post_status = 'publish';
                        $postWordpress->post_excerpt = $post->excerpt ? $post->excerpt : "";
                        $postWordpress->to_ping = '';
                        $postWordpress->pinged = '';
                        $postWordpress->post_name = $post->slug;
                        $postWordpress->post_content_filtered = '';
                        $postWordpress->save();

                        $taxonomyId = $newTermTaxonomy->term_taxonomy_id;
                        $postWordpress->taxonomies()->sync([$taxonomyId]);
                    }

                }
            }
        }

        $this->info('Thành công');

    }

    public function handle()
    {

        // $this->wordpressApiLaravel();

        $this->createCategoriesWordpress();

        // $this->createPost();

    }
}
