<?php

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

// Route::get('/', function () {
//     $a=new Parsedown();
//     $a->setSafeMode(true);
//     $a->setMarkupEscaped(true);
//     $b=$a->text(Request()->markdowneditor);
//     return view('welcome',compact("b"));
// });

Route::view("/","welcome")->name("blog");

Auth::routes();
//['verify' => true]

Route::group(["prefix"=>"dashboard","middleware"=>["auth"]],function (){
    Route::get('', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
});
