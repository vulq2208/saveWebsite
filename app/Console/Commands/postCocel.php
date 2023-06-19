<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;
use App\Models\Post;
use App\Models\PostWordpress;
use Corcel\Model\PostMeta;


use Corcel\Model\Taxonomy;
use Corcel\Model\Term;


class postCocel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:postCocel';

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
        try {
            //get post from laravel
            $post = Post::first();

            //categories 
            $categories = $post->categories()->get();
            //dd($categories);
            /*'author_id','category_id','title','seo_title','excerpt','body','slug','image','meta_description','view','status','source','featured','created_at',*/
            //create post into wordpress
            $postWordpress = new PostWordpress;
            $postWordpress->post_title = $post->title;
            $postWordpress->post_content = $post->body;
            $postWordpress->post_status = 'publish';
            $postWordpress->post_excerpt = $post->excerpt ? $post->excerpt : "đâsdsa";
            $postWordpress->to_ping = '';
            $postWordpress->pinged = '';
            $postWordpress->post_content_filtered = '';



            $postWordpress->save();
            
            // Upload and attach the featured image to the post
            $imagePath = \Storage::path($post->image);
            //$attachment = $this->setFeaturedImage($imagePath,$postWordpress);

            //insert category into via cocel
            $category = new Taxonomy();
            $category->taxonomy = 'category';
            $category->description = 'dsadasdasdas';
            $category->parent = 0;
            $category->count = 1;
            $term = new Term();
            $term->name = 'demo';
            $term->slug = 'demo';
            $term->save();
            $category->term_id = $term->term_id;
            $saved = $category->save();
                
            $postWordpress->saveMeta([
                '_wp_attached_file' => $imagePath,
            //    '_wp_attachment_metadata' => serialize($array_meta_attachment)

              ]);

            $this->info('Thành công');   

        } catch (\Exception $e) {
            dd($e);
        }

    }

   

    public function handle()
    {

        // $this->wordpressApiLaravel();

        $this->wordpressApiLaravel();

    }




    //
// ...

public function setFeaturedImage($imagePath,$postWordpress){

    PostMeta::create([
        'post_id'=>$postWordpress->ID,
        'meta_key'=>'_thumbnail_ext_url',
        'meta_value'=>$imagePath
    ]);
        
}



}
