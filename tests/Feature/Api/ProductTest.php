<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_products_by_category()
    {
        $category = Category::factory()->create();

        Product::factory()->count(10)->create([
            'category_id' => $category->id
        ]);

        $response = $this->getJson("/categories/{$category->uuid}/products");

        $response->assertStatus(200)->assertJsonCount(10, 'data');
    }

    public function test_404_products_by_category()
    {
        $response = $this->getJson('/categories/invalid-category/products');

        $response->assertStatus(404);
    }

    public function test_get_product_by_category()
    {
        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'category_id' => $category->id
        ]);

        $response = $this->getJson("/categories/{$category->uuid}/products/{$product->uuid}");

        $response->assertStatus(200);
    }

    public function test_validation_create_product_by_category()
    {
        $category = Category::factory()->create();


        $response = $this->postJson("/categories/{$category->uuid}/products", []);

        $response->assertStatus(422);
    }

    public function test_create_product_by_category()
    {
        $category = Category::factory()->create();


        $response = $this->postJson("/categories/{$category->uuid}/products", [
            'category' => $category->uuid,
            'name' => 'HEADSET HP',
            'description' => 'HEADSET HP description',
            'image' => 'images/image.jpeg'
        ]);

        $response->assertStatus(201);
    }

    public function test_validation_update_product_by_category()
    {
        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'category_id' => $category->id
        ]);

        $response = $this->putJson("/categories/{$category->uuid}/products/{$product->uuid}", []);

        $response->assertStatus(422);
    }

    public function test_update_product_by_category()
    {
        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'category_id' => $category->id
        ]);

        $response = $this->putJson("/categories/{$category->uuid}/products/{$product->uuid}", [
            'category' => $category->uuid,
            'name' => 'new name'
        ]);

        $response->assertStatus(200);
    }

    public function test_delete_product()
    {
        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'category_id' => $category->id
        ]);

        $response = $this->deleteJson("/categories/{$category->uuid}/products/{$product->uuid}");

        $response->assertStatus(204);
    }

    public function test_404_delete_product()
    {
        $category = Category::factory()->create();

        $response = $this->deleteJson("/categories/{$category->uuid}/products/uuid-invalid");

        $response->assertStatus(404);
    }
}
