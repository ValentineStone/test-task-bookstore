<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $visible = ['id', 'title', 'price'];

    public function authors()
    {
        return $this->belongsToMany('App\Author', 'book_authors');
    }

    public function scopeWhereAuthor($query, $author)
    {
        return $query->whereHas('authors', function($q) use ($author) {
            $q->where('id', $author);
        });
    }

    public function getPriceMinorAttribute()
    {
        return str_pad(floor(($this->price - floor($this->price)) * 100), 2, '0', STR_PAD_LEFT);
    }

    public function getPriceMajorAttribute()
    {
        return floor($this->price);
    }
}
