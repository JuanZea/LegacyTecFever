<?php

namespace Tests\Feature\Api\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\TestHelpers;

class StoreProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_store_products()
    {
        // Arrange
        TestHelpers::activeRoles();
        $admin = factory(User::class)->create(['is_enabled' => true])->assignRole('admin');
        $product = factory(Product::class)->raw(['is_enabled' => 1]);

        // Act
        $response = $this->postJson(route('api.products.store', ['api_token' => $admin->api_token,]), $product);

        // Assert
        $response->assertStatus(201);
        $response->assertJsonFragment([
                'type' => 'products'
        ]);
        $this->assertDatabaseHas('products', $product);
    }
}
