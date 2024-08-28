<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::create([
            Tag::TITLE=>'Tag 1',
            Tag::SLUG=>'tag-1',
        ]);

        Tag::create([
            Tag::TITLE=>'Tag 2',
            Tag::SLUG=>'tag-2',
        ]);

        Tag::create([
            Tag::TITLE=>'Tag 3',
            Tag::SLUG=>'tag-3',
        ]);
    }
}
