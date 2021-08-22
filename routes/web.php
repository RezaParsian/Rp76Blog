<?php

use App\Http\Controllers\{Blog\BlogController};
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

Route::group(["prefix" => "blog"], function () {
    Route::get("post/{slug:slug}", [BlogController::class, "post"])->name("post.single");
});
