<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookTitle;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BookTitle::create([
            'title' => 'Good Book Volume 1',
            'language_id' => 1,
            'self_id' => 1,
            'author_id' => [1],
            'volume' => 2,
        ]);
        Book::insert([
            [
                'title'=> 'Good Book Volume 1',
                'book_no'=> 1,
                'title_id'=> 1,
                'language_id'=> 1,
                'self_id'=> 1,
                'taak'=> 'A',
                'part'=> 2,
                'price'=> 0,
                'purchase_at'=> now(),
            ],
            [
                'title'=> 'Good Book Volume 2',
                'book_no'=> 2,
                'title_id'=> 1,
                'language_id'=> 1,
                'self_id'=> 1,
                'taak'=> 'A',
                'part'=> 2,
                'price'=> 0,
                'purchase_at'=> now(),
            ],
        ]);
    }
}
