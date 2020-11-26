<?php

namespace Tests\Feature\Api\Products;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_store_products()
    {
        $this->withoutExceptionHandling();

        // Arrange
        $product = factory(Product::class)->raw(['isEnabled' => 1]);

        // Act
        $response = $this->postJson(route('api.products.store'), $product);

        // Assert
        $response->assertStatus(201);
        $response->assertJsonFragment([
                'type' => 'products'
        ]);
        $this->assertDatabaseHas('products', $product);
    }
}
