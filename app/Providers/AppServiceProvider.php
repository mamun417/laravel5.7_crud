<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view::composer('admin.layouts.master', function ($current_controller){
            $current_controller->with('current_controller', class_basename(Route::current()->controller));
        });

        view::composer('admin.layouts.master', function ($current_route){
            $current_route->with('current_route', Route::current()->uri());
        });

        view::composer('admin.layouts.master', function ($current_route_name){
            $current_route_name->with('current_route_name', Route::currentRouteName());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
