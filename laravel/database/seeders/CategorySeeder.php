<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiction',     'color' => '#6366f1'],
            ['name' => 'Sci-Fi',      'color' => '#0ea5e9'],
            ['name' => 'Biography',   'color' => '#f59e0b'],
            ['name' => 'History',     'color' => '#84cc16'],
            ['name' => 'Self-Help',   'color' => '#ec4899'],
            ['name' => 'Business',    'color' => '#14b8a6'],
        ];

        \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Category::truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1');
        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
