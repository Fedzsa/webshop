<?php

namespace App\Providers;

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
        // binding services
        $this->app->bind('App\Services\User\UserServiceInterface', 'App\Services\User\UserService');
        $this->app->bind('App\Services\Product\ProductServiceInterface', 'App\Services\Product\ProductService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
