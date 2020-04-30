<?php

namespace App\Providers;

use App\Models\File;
use App\Observers\FileObserver;
use Illuminate\Support\ServiceProvider;

class FileServiceProvider extends ServiceProvider {

    public function boot() {
        File::observe(FileObserver::class);
    }
}