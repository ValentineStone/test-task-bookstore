<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $visible = ['id', 'name'];

    public function books()
    {
        return $this->belongsToMany('App\Book', 'book_authors');
    }

    public function scopeWhereBook($query, $book)
    {
        return $query->whereHas('books', function($q) use ($book) {
            $q->where('id', $book);
        });
    }
}
