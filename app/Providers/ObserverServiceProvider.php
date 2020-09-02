<?php

namespace App\Providers;

use App\Models\File;
use App\Models\Product;
use App\Models\Category;
use App\Models\Specification;
use App\Observers\FileObserver;
use App\Observers\ProductObserver;
use App\Observers\CategoryObserver;
use Illuminate\Support\ServiceProvider;
use App\Observers\SpecificationObserver;

class ObserverServiceProvider extends ServiceProvider
{
    public function boot()
    {
        File::observe(FileObserver::class);
        Product::observe(ProductObserver::class);
        Category::observe(CategoryObserver::class);
        Specification::observe(SpecificationObserver::class);
    }
}
