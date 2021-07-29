<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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
    }
}
