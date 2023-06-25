<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\BookCategory;
use App\BookBorrow;

class Book extends Model
{
    protected $hidden = ['created_at', 'updated_at'];
    protected $fillable = [
        'title', 'author', 'category', 'isbn', 'published_date', 'quantity'
    ];

    public function category()
    {
        return $this->belongsTo(BookCategory::class, 'id');
    }
    public function borrowed()
    {
        return $this->hasMany(BookBorrow::class, 'id');
    }
    //
}
