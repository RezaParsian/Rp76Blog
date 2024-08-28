<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testBlogPageCanBeRender(): void
    {
        $response = $this->get(route('blog'));

        $response->assertStatus(200);
    }
}
