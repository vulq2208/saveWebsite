<?php

use Weidner\Goutte\GoutteFacade;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaveWebsiteController;

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

Route::get('/', function() {
    $crawler = GoutteFacade::request('GET', 'https://dantri.com.vn/lao-dong-viec-lam/can-tho-f0-f1-bot-lo-lang-vi-khong-phai-tra-vien-phi-20210829181940605.htm');
    $title = $crawler->filter('h1.dt-news__title')->each(function ($node) {
        return $node->text();
    })[0];
    print($title);
    return view('welcome');
});
Route::get('/get-saveWebsite', [SaveWebsiteController::class, 'getSaveWebsiteController']);
