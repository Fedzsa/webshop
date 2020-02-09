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
        // binding repositories
        $this->app->bind('App\Repositories\User\UserRepositoryInterface', 'App\Repositories\User\UserRepository');
        $this->app->bind('App\Repositories\Product\ProductRepositoryInterface', 'App\Repositories\Product\ProductRepository');

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
