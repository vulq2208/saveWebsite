<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;
use App\Models\Category;
class Post extends Model
{
    use SoftDeletes;
	protected $dates = ['deleted_at'];

    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'seo_title',
        'excerpt',
        'body',
        'slug',
        'image',
        'meta_description',
        'view',
        'status',
        'source',
        'featured',
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_posts');
    }




}
