<?php

namespace Tests\Feature;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TagTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testIndexPageCanBeRender(): void
    {
        $response = $this->actingAs(User::first())
        ->get(route('tag.index'));

        $response->assertOk();
    }

    public function testCreatePageCanBeRender()
    {
        $response = $this->actingAs(User::first())
            ->get(route('tag.create'));

        $response->assertOk();
    }

    public function testCreateTag()
    {
        $response = $this->actingAs(User::first())
            ->post(route('tag.store'), [
                Tag::TITLE=>'Test Tag',
                Tag::SLUG=>uniqid(),
            ]);

        $response->assertValid();
        $response->assertRedirect();
    }

    public function testCanNotCreateTagWithoutData()
    {
        $response = $this->actingAs(User::first())
            ->post(route('tag.store'));

        $response->assertInvalid();
        $response->assertRedirect();
    }

    public function testUpdateTag()
    {
        $tag=Tag::factory()->create();

        $response = $this->actingAs(User::first())
            ->put(route('tag.update', $tag->id), [
                Tag::TITLE=>'Test Tag',
                Tag::SLUG=>uniqid(),
            ]);

        $response->assertRedirect();
        $response->assertValid();
    }

    public function testCanNotUpdateTagWithoutData()
    {
        $tag=Tag::factory()->create();

        $response = $this->actingAs(User::first())
            ->put(route('tag.update', $tag->id));

        $response->assertRedirect();
        $response->assertInvalid();
    }

    public function testDeleteTag()
    {
        $tag=Tag::orderBy('id','desc')->first();

        $response = $this->actingAs(User::first())
            ->delete(route('tag.destroy', $tag->id));

        $response->assertRedirect();
    }
}
