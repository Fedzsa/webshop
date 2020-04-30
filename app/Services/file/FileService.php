<?php

namespace App\Services\File;

use App\Models\File;
use App\Models\Product;
use Illuminate\Http\File as HttpFile;
use Illuminate\Support\Facades\Storage;
use App\Services\File\FileServiceInterface;

class FileService implements FileServiceInterface {
    private File $file;
    
    public function __construct(File $file) {
        $this->file = $file;
    }

    public function store(Product $product, $file) {
        $newFileName = time().'.'.$file->extension();

        Storage::putFileAs('public', $file, $newFileName);

        return $this->file->create([
            'name' => $newFileName,
            'original_name' => $file->getClientOriginalName(),
            'extension' => $file->extension(),
            'path' => 'storage/public',
            'product_id' => $product->id
        ]);
    }

    public function destroy(File $file) {
        return $file->delete();
    }
}