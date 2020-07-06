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

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    /**
     * Store the uploaded file to the storage folder.
     * This file is a picture which belongs to the specific product.
     * @param Product $product The file belongs to this.
     * @param $file Uploaded file.
     * @return mixed
     */
    public function store(Product $product, $file)
    {
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

    /**
     * Delete the file.
     *
     * @param File $file
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(File $file)
    {
        return $file->delete();
    }
}
