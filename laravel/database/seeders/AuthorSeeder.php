<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $authors = [
            ['name' => 'F. Scott Fitzgerald', 'nationality' => 'American'],
            ['name' => 'George Orwell',        'nationality' => 'British'],
            ['name' => 'Harper Lee',           'nationality' => 'American'],
            ['name' => 'Jane Austen',          'nationality' => 'British'],
            ['name' => 'David McCloskey',      'nationality' => 'American'],
            ['name' => 'Lena Bennett',         'nationality' => 'Canadian'],
        ];

        foreach ($authors as $a) {
            Author::create($a);
        }
    }
}
