<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Book;
use App\User;

class BookBorrow extends Model
{
    protected $fillable = [
        'book_id', 'user_id', 'due_date'
    ];
    //
    public function book()
    {
        return $this->hasOne(Book::class, 'id', 'book_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public static function unreturned()
    {
        return self::whereNull('returned_date');
    }
}
