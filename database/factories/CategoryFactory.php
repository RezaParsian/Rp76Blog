<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 *
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Category::TITLE=>fake()->title(),
            Category::PARENT_ID=>null,
            Category::SLUG=>fake()->slug
        ];
    }
}
