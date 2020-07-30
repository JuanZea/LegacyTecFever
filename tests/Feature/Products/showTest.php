<?php

namespace Tests\Feature\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class showTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Tests for show Products
     *
     * @test
     */
    public function anUserCanShowProducts()
    {
        // Arrange
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->get(route('products.show',$product));

        // Assert
        $response->assertOk();
        $response->assertViewIs('products.show');
        $response->assertViewHas('product');
        $responseProduct = $response->getOriginalContent()['product']->toArray();
        $this->assertDatabaseHas('products',removeTimeKeys($responseProduct));
    }

    /**
     * Tests for show Products
     *
     * @test
     */
    public function anGuestCannotShowProducts()
    {
        // Arrange
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        // Act
        $response = $this->get(route('products.show',$product));

        // Assert
        $response->assertRedirect('login');
    }
}
