<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function specifications() {
        return $this->hasMany('App\Models\Specification');
    }
}
