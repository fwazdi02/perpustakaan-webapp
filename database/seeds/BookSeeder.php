<?php 

use Illuminate\Database\Seeder;
use App\Book;

class BookSeeder extends Seeder
{
    public function run()
    {
        $popularBooks = [
            [
                'title' => 'The Catcher in the Rye',
                'author' => 'J.D. Salinger',
                'category_id' => 2,
                'quantity' => 5,
                'isbn' => '9780316769488',
                'published_date' => '1951-07-16',
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'category_id' => 2,
                'quantity' => 2,
                'isbn' => '9780061120084',
                'published_date' => '1960-07-11',
            ],
            [
                'title' => 'Laskar Pelangi',
                'author' => 'Andrea Hirata',
                'category_id' => 2,
                'quantity' => 5,
                'isbn' => '9789792294064',
                'published_date' => '2005-08-01',
            ],
            [
                'title' => 'Negeri 5 Menara',
                'author' => 'Ahmad Fuadi',
                'category_id' => 2,
                'quantity' => 6,
                'isbn' => '9789792299502',
                'published_date' => '2009-08-01',
            ],
            [
                'title' => 'The Diary of a Young Girl',
                'author' => 'Anne Frank',
                'category_id' => 5,
                'quantity' => 5,
                'isbn' => '9780553296983',
                'published_date' => '1947-06-25',
            ],
            [
                'title' => 'Long Walk to Freedom',
                'author' => 'Nelson Mandela',
                'category_id' => 5,
                'quantity' => 4,
                'isbn' => '9780316548182',
                'published_date' => '1994-10-01',
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'category_id' => 3,
                'quantity' => 2,
                'isbn' => '9780141439518',
                'published_date' => '1813-01-28',
            ],
            [
                'title' => 'The Notebook',
                'author' => 'Nicholas Sparks',
                'category_id' => 3,
                'quantity' => 8,
                'isbn' => '9780446615153',
                'published_date' => '1996-10-01',
            ],
        ];

        foreach ($popularBooks as $bookData) {
            Book::create($bookData);
        }
    }
}