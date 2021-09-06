<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
        View::share("twits", Article::where(Article::TYPE, "twit")->orderBy("id", "DESC")->take(4)->get());
        View::share("cats", Category::where(Category::PARENT_ID, 0)->get());
    }
}
