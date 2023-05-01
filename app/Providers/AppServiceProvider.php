<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (!env("APP_DEBUG")) {
            $this->app->bind('path.public', function () {
                return realpath(base_path() . '/../public_html');
            });
        }

        if (env("APP_DEBUG")) {
            DB::enableQueryLog();
        }

        Blade::if('may', function ($scope) {
            return Auth::user()->may($scope);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        if (Schema::hasTable("articles")) {
            $twits = Cache::rememberForever('twits', function () {
                return Article::where(Article::TYPE, "twit")->orderBy("id", "DESC")->take(4)->get();
            });

            $cats = Cache::rememberForever('cats', function () {
                return Category::where(Category::PARENT_ID, 0)->get();
            });

            $tags = Cache::rememberForever('tags', function () {
                return Tag::all();
            });

            $owner = Cache::rememberForever('owner', function () {
                return User::first();
            });

            View::share("twits", $twits);
            View::share("cats", $cats);
            View::share("tags", $tags);
            View::share("owner", $owner);
        }
    }
}
