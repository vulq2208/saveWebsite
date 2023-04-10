<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
 class Category extends Model
{


    protected $table = 'categories';
    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'order',
    ];

    /**
     * Get all of the posts for the user.
     */
    public function posts()
    {
         return $this->belongsToMany(Post::class, 'category_posts');
    }

     public function parentId()
    {
        return $this->belongsTo(self::class);
    }

}
