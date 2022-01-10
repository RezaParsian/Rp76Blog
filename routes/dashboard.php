<?php

use App\Http\Controllers\{Dashboard\ArticleController, Dashboard\CategoryController, Dashboard\TagController, HomeController};
use Illuminate\Support\{Facades\Auth, Facades\Route};

Route::name('dashboard')->get('', [HomeController::class, 'index']);
Route::resource("article", ArticleController::class);
Route::resource("category", CategoryController::class);
Route::resource("tag", TagController::class);
