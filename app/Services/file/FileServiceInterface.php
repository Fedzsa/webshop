<?php

namespace App\Services\File;

use App\Models\File;
use App\Models\Product;

interface FileServiceInterface
{
    function store(Product $product, $file);
    function destroy(File $file);
}
