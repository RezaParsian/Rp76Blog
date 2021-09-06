<?php

use App\Models\Role;
use App\Http\Controllers\{Blog\BlogController};
use Illuminate\Support\{Facades\Artisan, Facades\Auth, Facades\Route};

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
//Route::get("onlymigrate", function () {
//    Artisan::call("migrate");
//    $roles = json_encode(array_filter(explode("\n", file_get_contents(__DIR__ . "/../role"))));
//    $role = Role::find(1);
//    $role->update([Role::SCOPE => $roles]);
//    return $role;
//});

Route::view("/", "welcome")->name("blog");

Auth::routes(['register' => false]);
//['verify' => true]

Route::group(["prefix" => "blog"], function () {
    Route::get("post/{slug:slug}", [BlogController::class, "post"])->name("post.single");
});


Route::get("rp",function (){
    $post=\App\Models\Article::where("id",1)->with('categorize')->get();
    return $post;
});
