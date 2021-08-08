<?php

use App\Http\Controllers\{Blog\BlogController, Dashboard\ArticleController, Dashboard\CategoryController, HomeController};
use Illuminate\Support\{Facades\Auth, Facades\Route};

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

Route::view("/", "welcome")->name("blog");

Auth::routes();
//['verify' => true]

Route::group(["prefix" => "dashboard", "middleware" => ["auth"]], function () {
    Route::name('dashboard')->get('', [HomeController::class, 'index']);
    Route::resource("article", ArticleController::class);
    Route::resource("category", CategoryController::class);
});

Route::group(["prefix" => "blog"], function () {
    Route::get("post/{slug:slug}", [BlogController::class, "post"])->name("post.single");
});
