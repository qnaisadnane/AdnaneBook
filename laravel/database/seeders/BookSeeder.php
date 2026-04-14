<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $fiction    = Category::where('name', 'Fiction')->first();
        $scifi      = Category::where('name', 'Sci-Fi')->first();
        $biography  = Category::where('name', 'Biography')->first();
        $history    = Category::where('name', 'History')->first();
        $selfHelp   = Category::where('name', 'Self-Help')->first();
        $business   = Category::where('name', 'Business')->first();

        $fitzgerald = Author::where('name', 'F. Scott Fitzgerald')->first();
        $orwell     = Author::where('name', 'George Orwell')->first();
        $lee        = Author::where('name', 'Harper Lee')->first();
        $austen     = Author::where('name', 'Jane Austen')->first();
        $mccloskey  = Author::where('name', 'David McCloskey')->first();
        $bennett    = Author::where('name', 'Lena Bennett')->first();

        $books = [
            [
                'title'       => 'The Great Gatsby',
                'isbn'        => '978-0743273565',
                'price'       => 15.99,
                'quantity'    => 30,
                'category_id' => $fiction?->id,
                'authors'     => [$fitzgerald?->id],
            ],
            [
                'title'       => '1984',
                'isbn'        => '978-0451524935',
                'price'       => 14.20,
                'quantity'    => 45,
                'category_id' => $scifi?->id,
                'authors'     => [$orwell?->id],
            ],
            [
                'title'       => 'To Kill a Mockingbird',
                'isbn'        => '978-0061935466',
                'price'       => 12.50,
                'quantity'    => 25,
                'category_id' => $fiction?->id,
                'authors'     => [$lee?->id],
            ],
            [
                'title'       => 'Pride and Prejudice',
                'isbn'        => '978-0141439518',
                'price'       => 10.99,
                'quantity'    => 50,
                'category_id' => $fiction?->id,
                'authors'     => [$austen?->id],
            ],
            [
                'title'       => 'Damascus Station',
                'isbn'        => '978-1982167691',
                'price'       => 18.99,
                'quantity'    => 20,
                'category_id' => $fiction?->id,
                'authors'     => [$mccloskey?->id],
            ],
            [
                'title'       => 'Animal Farm',
                'isbn'        => '978-0451526342',
                'price'       => 9.99,
                'quantity'    => 60,
                'category_id' => $scifi?->id,
                'authors'     => [$orwell?->id],
            ],
            [
                'title'       => 'How to Stop Overthinking',
                'isbn'        => '978-1647800093',
                'price'       => 15.99,
                'quantity'    => 35,
                'category_id' => $selfHelp?->id,
                'authors'     => [$bennett?->id],
            ],
            [
                'title'       => 'Sense and Sensibility',
                'isbn'        => '978-0141439662',
                'price'       => 11.50,
                'quantity'    => 28,
                'category_id' => $fiction?->id,
                'authors'     => [$austen?->id],
            ],
            [
                'title'       => 'Brave New World',
                'isbn'        => '978-0060850524',
                'price'       => 13.99,
                'quantity'    => 40,
                'category_id' => $scifi?->id,
                'authors'     => [$orwell?->id],
            ],
            [
                'title'       => 'Atomic Habits',
                'isbn'        => '978-0735211292',
                'price'       => 22.99,
                'quantity'    => 55,
                'category_id' => $business?->id,
                'authors'     => [$bennett?->id],
            ],
            [
                'title'       => 'Sapiens',
                'isbn'        => '978-0062316097',
                'price'       => 19.99,
                'quantity'    => 42,
                'category_id' => $history?->id,
                'authors'     => [$fitzgerald?->id],
            ],
            [
                'title'       => 'The Art of War',
                'isbn'        => '978-1599869773',
                'price'       => 8.50,
                'quantity'    => 70,
                'category_id' => $business?->id,
                'authors'     => [$lee?->id],
            ],
        ];

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \DB::table('author_book')->truncate();
        Book::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
        foreach ($books as $data) {
            $authorIds = array_filter($data['authors'] ?? []);
            unset($data['authors']);
            $book = Book::create($data);
            if (!empty($authorIds)) {
                $book->authors()->sync($authorIds);
            }
        }
    }
}
