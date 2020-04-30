<?php

namespace App\Models;

use App\Jobs\DeleteFile;
use Illuminate\Database\Eloquent\Model;

class File extends Model {
    
    protected $fillable = ['name', 'original_name', 'extension', 'path', 'product_id'];

    public function product() {
        return $this->belongsTo('App\Models\Product');
    }
}
