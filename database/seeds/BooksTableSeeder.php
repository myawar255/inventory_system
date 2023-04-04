<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'name' => 'The Hitchhiker\'s Guide to the Galaxy',
                'desc' => 'A science fiction comedy series by Douglas Adams.',
                'category_id' => 1,
                'author_id' => 1,
                'isbn_number' => '978-0345391803',
                'price' => '10.99',
                'qty' => 3,
                'remaining' => 3,
                'cover_image' => null,
                'published_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'The Da Vinci Code',
                'desc' => 'A mystery thriller novel by Dan Brown.',
                'category_id' => 2,
                'author_id' => 2,
                'isbn_number' => '978-0307474278',
                'price' => '12.99',
                'qty' => 3,
                'remaining' => 3,
                'cover_image' => null,
                'published_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pride and Prejudice',
                'desc' => 'A romantic novel by Jane Austen.',
                'category_id' => 3,
                'author_id' => 3,
                'isbn_number' => '978-0486284736',
                'price' => '8.99',
                'qty' => 3,
                'remaining' => 3,
                'cover_image' => null,
                'published_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
