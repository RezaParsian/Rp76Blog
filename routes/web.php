<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::resource("article", ArticleController::class);
});

Route::group(["prefix"=>"blog"],function (){
    Route::get("post/{slug:slug}",[BlogController::class,"post"])->name("post.single");
});
