<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use JsonException;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testArticlePageCanBeLoaded(): void
    {
        $this->actingAs(User::first());

        $response = $this->get(route('article.index'));

        $response->assertStatus(200);
    }

    public function testArticleCreateFromCanBeRender()
    {
        $this->actingAs(User::first());

        $response = $this->get(route('article.create'));

        $response->assertStatus(200);
    }

    public function testArticleCanBeCreated(): void
    {
        $this->actingAs(User::first());

        $file = UploadedFile::fake()->image('image.jpg');

        $response = $this->post(route('article.store'), [
            Article::TITLE => 'Test Article',
            Article::SLUG => 'test-article',
            Article::TYPE => Article::TYPE_BLOG,
            Article::IMAGE => $file,
            Article::CONTENT => 'lorem ipsum',
            "category_id" => 1,
            "tags" => [
                1, 2, 3
            ]
        ]);

        $response->assertRedirect();
    }

    public function testArticleCanNotBeCreatedWithoutData(): void
    {
        $this->actingAs(User::first());

        $response = $this->post(route('article.store'));

        $response->assertRedirect();
        $response->assertSessionHasErrors();
    }

    /**
     * @throws JsonException
     */
    public function testArticleCanUpdate(): void
    {
        $this->actingAs(User::first());

        $response=$this->put(route('article.update',Article::first()->id), [
            Article::TITLE => 'Update Test Article',
            Article::SLUG => 'update-test-article',
            Article::CATEGORY_ID=>1,
            Article::CONTENT => 'updated lorem ipsum',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }

    public function testArticleCanNotUpdateWithoutData(): void
    {
        $this->actingAs(User::first());
        $response = $this->put(route('article.update',Article::first()->id));

        $response->assertRedirect();
        $response->assertSessionHasErrors();
    }

    /**
     * @return void
     * @throws JsonException
     */
    public function testArticleCanBeDelete()
    {
        $this->actingAs(User::first());
        $response=$this->delete(route('article.destroy',Article::first()->id));

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();
    }
}
