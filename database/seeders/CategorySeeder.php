<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            Category::PARENT_ID=>null,
            Category::TITLE=>'Category 1',
            Category::SLUG=>'category-1',
        ]);

        Category::create([
            Category::PARENT_ID=>null,
            Category::TITLE=>'Category 2',
            Category::SLUG=>'category-2',
        ]);

        Category::create([
            Category::PARENT_ID=>1,
            Category::TITLE=>'Category 1-1',
            Category::SLUG=>'category-1-1',
        ]);
    }
}
