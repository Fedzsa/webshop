<?php

namespace App\Observers;

use App\Models\File;
use App\Jobs\DeleteFile;

class FileObserver
{
    /**
     * Handle the file "deleted" event.
     *
     * @param  \App\Models\File  $file
     * @return void
     */
    public function deleted(File $file)
    {
        DeleteFile::dispatch($file->name);
    }
}
