<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testCategoryIndexCanBeRender(): void
    {
        $response = $this->actingAs(User::first())
            ->get(route('category.index'));

        $response->assertOk();
    }

    public function testCategoryCreatePageCanBeRender()
    {
        $response = $this->actingAs(User::first())
            ->get(route('category.create'));

        $response->assertOk();
    }

    public function testCreateCategory()
    {
        $response = $this->actingAs(User::first())
            ->post(route('category.store'), [
                Category::TITLE => 'Test Category',
                Category::PARENT_ID => null,
                Category::SLUG => 'test-category',
            ]);

        $response->assertRedirect();
        $response->assertValid();
    }

    public function testCanNotCreateCategoryWithoutData()
    {
        $response = $this->actingAs(User::first())
            ->post(route('category.store'));

        $response->assertRedirect();
        $response->assertInvalid();
    }

    public function testUpdateCategory()
    {
        $category = Category::factory()->create();

        $response = $this->actingAs(User::first())
            ->put(route('category.update', $category->id), [
                Category::TITLE => 'Test Category',
                Category::PARENT_ID => null,
                Category::SLUG => 'test-category',
            ]);

        $response->assertRedirect();
        $response->assertValid();
    }

    public function testCanNotUpdateCategoryWithoutData()
    {
        $category = Category::factory()->create();

        $response = $this->actingAs(User::first())
            ->put(route('category.update', $category->id));

        $response->assertRedirect();
        $response->assertInvalid();
    }

    public function testDeleteCategory()
    {
        $response = $this->actingAs(User::first())
            ->delete(route('category.destroy', Category::orderBy('id', 'desc')->first()->id));

        $response->assertRedirect();
    }
}
