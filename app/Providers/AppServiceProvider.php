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
        $this->app->bind('App\Services\Category\CategoryServiceInterface', 'App\Services\Category\CategoryService');
        $this->app->bind('App\Services\Specification\SpecificationServiceInterface', 'App\Services\Specification\SpecificationService');
        $this->app->bind('App\Services\File\FileServiceInterface', 'App\Services\File\FileService');
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
