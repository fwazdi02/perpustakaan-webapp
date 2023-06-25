<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BookCategory;

class Book extends Model
{
    protected $fillable = [
        'title', 'author', 'category', 'isbn', 'published_date', 'quantity'
    ];

    public function category()
    {
        return $this->belongsTo(BookCategory::class, 'id');
    }
    //
}
