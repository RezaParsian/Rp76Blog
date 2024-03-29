<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\Dashboard\ArticleController;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/post", function (Request $request) {
    return Article::where(function ($query) use ($request) {
        $query->where("title", "like", "%{$request->q}%")->orWhere("content", "like", "%{$request->q}%");
    })->with(["user" => function ($query) {
        return $query->select("id", "name");
    }])->where(Article::TYPE,"blog")->orderby("id", "DESC")
        ->paginate();
});

Route::any("bot",[BotController::class,"index"]);

Route::put('article/{article}', [ArticleController::class,'reaction']);