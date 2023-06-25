<?php

use Illuminate\Database\Seeder;
use App\BookCategory;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Science Fiction',
                'description' => 'Category description'
            ],
            [
                'name' => 'Fiction',
                'description' => 'Category description'
            ],
            [
                'name' => 'Romance',
                'description' => 'Category description'
            ],
            [
                'name' => 'Horror',
                'description' => 'Category description'
            ],
            [
                'name' => 'Biography/Autobiography',
                'description' => 'Category description'
            ],
        ];

        foreach ($categories as $category) {
            BookCategory::create($category);
        }
    }
}
