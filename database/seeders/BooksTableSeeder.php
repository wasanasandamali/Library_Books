<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('books')->insert([
            [
                'title' => 'Book One',
                'description' => 'Description for book one',
                'genre' => 'Fiction',
                'price' => 10.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Book Two',
                'description' => 'Description for book two',
                'genre' => 'Non-fiction',
                'price' => 12.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more books as needed
        ]);
    }
}
