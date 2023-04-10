<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class ParentController extends Controller
{
    /*
     *  Author : Sap
     *  Date Create : 10/04/2023
     *  Description : get data of categories and posts
     *  Parameter :$slug
     *  Return : $posts, $categoriesSlug
     */
    public function viewParent($slug)
    {
        $categoriesId = Category::where('slug', '=', $slug)->pluck('id')->toArray();

        $categoriesSlug = Category::where('slug', '=', $slug)->firstOrFail();

        $posts = Post::with('categories')
            ->whereHas('categories', function ($query) use ($categoriesId) {
                $query->whereIn('category_id', $categoriesId);
            })
            ->where('image', '!=', '.')
            ->select('title', 'image', 'slug')
            ->paginate(10);
        return view('Parent.parent', ['posts' => $posts, 'categoriesSlug' => $categoriesSlug]);
    }

    /*
     *  Author : Sap
     *  Date Create : 10/04/2023
     *  Description : get data of article details
     *  Parameter :$slugParent, $slug
     *  Return : $post
     */
    public function detailPost($slugParent, $slug)
    {
        $categoryId = Category::where('slug', '=', $slugParent)->pluck('id')->firstOrFail();

        $post = Post::whereHas('categories', function ($query) use ($categoryId) {
            $query->where('categories.id', '=', $categoryId);
        })
            ->where('slug', '=', $slug)
            ->firstOrFail();
        return view('detail.detail', ['post' => $post]);
    }
}
