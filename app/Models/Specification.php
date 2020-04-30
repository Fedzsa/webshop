<?php

namespace App\Models;

use App\Helpers\Database\MySQLQueryHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specification extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    protected  $searchable = ['name'];

    public function products() {
        return $this->belongsToMany('App\Models\Product');
    }

    public function resolveRouteBinding($value) {
        return $this->withTrashed()->findOrFail($value);
    }

    public function scopeSearch($query, $text) {
        if(!isset($text))
            return $query;

        $text .= MySQLQueryHelper::wildcards[0];
        return $query->whereRaw(MySQLQueryHelper::generateFullTextSearchQueryPart($this->searchable), [$text]);
    }
}
