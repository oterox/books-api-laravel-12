<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            [
                'title' => 'The Great Gatsby',
                'author' => 'F. Scott Fitzgerald',
                'description' => 'A story of the fabulously wealthy Jay Gatsby and his love for the beautiful Daisy Buchanan.',
                'isbn' => '9780743273565',
                'published_year' => 1925,
                'price' => 12.99,
            ],
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'description' => 'The story of young Scout Finch and her father Atticus in a racially divided Alabama town.',
                'isbn' => '9780446310789',
                'published_year' => 1960,
                'price' => 14.99,
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'description' => 'A dystopian novel about totalitarianism and surveillance society.',
                'isbn' => '9780451524935',
                'published_year' => 1949,
                'price' => 11.99,
            ],
            [
                'title' => 'Pride and Prejudice',
                'author' => 'Jane Austen',
                'description' => 'A romantic novel of manners that follows the emotional development of Elizabeth Bennet.',
                'isbn' => '9780141439518',
                'published_year' => 1813,
                'price' => 9.99,
            ],
            [
                'title' => 'The Hobbit',
                'author' => 'J.R.R. Tolkien',
                'description' => 'A fantasy novel about the adventures of Bilbo Baggins, a hobbit who embarks on a quest.',
                'isbn' => '9780547928241',
                'published_year' => 1937,
                'price' => 15.99,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
