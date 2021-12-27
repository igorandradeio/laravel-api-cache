<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_categories()
    {
        $response = $this->getJson('/categories');

        $response->assertStatus(200);
    }

    public function test_get_count_categories()
    {
        Category::factory()->count(10)->create();

        $response = $this->getJson('/categories');

        $response->assertJsonCount(10, 'data');
        $response->assertStatus(200);
    }

    public function test_404_categories()
    {
        $response = $this->getJson('/categories/uuid-invalid');

        $response->assertStatus(404);
    }

    public function test_get_category()
    {
        $category = Category::factory()->create();

        $response = $this->getJson("/categories/{$category->uuid}");

        $response->assertStatus(200);
    }

    public function test_validations_create_category()
    {
        $response = $this->postJson('/categories/', []);

        $response->assertStatus(422);
    }

    public function test_create_category()
    {
        $response = $this->postJson('/categories/', [
            'name' => 'HEADSET',
            'description' => 'HEADSET description',
            'image' => 'images/image.jpeg'
        ]);

        $response->assertStatus(201);
    }

    public function test_validation_update_category()
    {
        $category = Category::factory()->create();

        $response = $this->putJson("/categories/{$category->uuid}", []);

        $response->assertStatus(422);
    }

    public function test_update_category()
    {
        $category = Category::factory()->create();

        $response = $this->putJson("/categories/{$category->uuid}", [
            'name' => 'new name'
        ]);

        $response->assertStatus(200);
    }

    public function test_404_update_category()
    {
        $response = $this->putJson('/categories/uuid-invalid', [
            'name' => 'new name'
        ]);

        $response->assertStatus(404);
    }

    public function test_delete_category()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/categories/{$category->uuid}");

        $response->assertStatus(204);
    }

    public function test_404_delete_category()
    {
        $response = $this->deleteJson('/categories/uuid-invalid');

        $response->assertStatus(404);
    }
}
