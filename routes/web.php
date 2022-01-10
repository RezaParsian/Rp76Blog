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
//$roles = json_encode(array_filter(explode("\n", str_replace("\r", "", file_get_contents(base_path("role"))))));
//    $role = Role::find(1);
//    $role->update([Role::SCOPE => $roles]);
//    return $role;
//});

Route::any("/", [BlogController::class, "index"])->name("blog");
Route::get("profile/{user:name}", [BlogController::class, "profile"])->name('profile');
Route::post("profile/{user:name}", [BlogController::class, "profileSave"])->name('profile.save');

Auth::routes(['register' => true, "verify" => false]);

Route::group(["prefix" => "blog"], function () {
    Route::get("post/{slug:slug}", [BlogController::class, "post"])->name("post.single");
});
