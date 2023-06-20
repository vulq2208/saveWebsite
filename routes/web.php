<?php

use App\Http\Controllers\ParentController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('/', function () {
    $categories = Category::get();

    foreach ($categories as $category) {
        // Retrieve posts for each category
        $posts = $category->posts()->get();

        foreach ($posts as $post) {
            // Retrieve categories for each post
            $postCategories = $post->categories()->get();

            dd($postCategories); // Dump and die to inspect the retrieved categories

        }
    }

});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/{slug}/new', [ParentController::class, 'newPost'])->name('new-post');

Route::get('/{slug}', [ParentController::class, 'viewParent'])->name('parent-view');
Route::get('/{slugParent}/{slug}', [ParentController::class, 'detailPost'])->name('post-view');

// URL::forceScheme('https');
