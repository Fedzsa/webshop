<?php

namespace App\Services\File;

use App\Models\File;
use App\Models\Product;
use Illuminate\Http\File as HttpFile;
use Illuminate\Support\Facades\Storage;
use App\Services\File\FileServiceInterface;
use Image;

class FileService implements FileServiceInterface {
    private File $file;
    
    public function __construct(File $file) {
        $this->file = $file;
    }

    public function store(Product $product, $file) {
        $newFileName = time().'.'.$file->extension();
        
        $resizedImage = Image::make($file)->fit(300, 300);
        $resizedImage->save(public_path('storage/'.$newFileName));

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