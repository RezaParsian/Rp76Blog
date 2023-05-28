<?php

use App\Http\Controllers\{Dashboard\ArticleController, Dashboard\CategoryController, Dashboard\CrmController, Dashboard\TagController, HomeController};
use Illuminate\Support\{Facades\Route};

Route::name('dashboard')->get('', [HomeController::class, 'index']);
Route::resource("article", ArticleController::class);
Route::resource("category", CategoryController::class);
Route::resource("tag", TagController::class);
Route::resource('crm', CrmController::class);
Route::post("crm/switch", [CrmController::class, "switchUser"])->name('crm.switch.user')->middleware('role:admin');
