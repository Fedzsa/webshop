<?php

namespace App\Providers;

use App\Models\File;
use App\Models\Product;
use App\Observers\FileObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider {

    public function boot() {
        File::observe(FileObserver::class);
        Product::observe(ProductObserver::class);
    }
}