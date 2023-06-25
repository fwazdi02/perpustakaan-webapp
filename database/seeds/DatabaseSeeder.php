<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BookCategorySeeder::class);
        $this->call(BookSeeder::class);
        $user = factory(App\User::class, 10)->create();
    }
}
