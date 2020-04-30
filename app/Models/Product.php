<?php

namespace App\Models;

use App\Helpers\Database\MySQLQueryHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'price', 'description', 'category_id'
    ];

    protected  $searchable = ['name', 'description'];

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function specifications() {
        return $this->belongsToMany('App\Models\Specification')->withPivot(['value', 'deleted_at']);
    }

    public function files() {
        return $this->hasMany('App\Models\File');
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

    public function getTruncatedDescription() {
        return $this->description ? substr($this->description, 0, 50).'...' : '';
    }
}
