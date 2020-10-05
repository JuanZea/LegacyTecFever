<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchBarTest extends TestCase
{
    /**
     * Check that a guest cannot search for products
     * @test
     */
    public function AGuestCannotSearchAProduct()
    {
        // Arrange
        $product = factory(Product::class)->create();

        // Act
        $response = $this->get(route('products.shop',['name' => $product->name]));

        // Assert
        $response->assertRedirect('login');
    }

    /**
     * Check that a enabled user can search for products
     * @test
     */
    public function AEnabledUserCanSearchAProduct()
    {
        // Arrange
        $user = factory(User::class)->create(['isEnabled' => true]);
        $product = factory(Product::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->get(route('products.shop',['name' => $product->name]));

        // Assert
        $response->assertOk();
        $response->assertViewIs('products.shop');
    }

    /**
     * Check that a admin can search for products
     * @test
     */
    public function AAdminCanSearchAProduct()
    {
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true,'isEnabled' => true]);
        $product = factory(Product::class)->create();

        // Act
        $this->actingAs($admin);
        $response = $this->get(route('products.shop',['name' => $product->name]));

        // Assert
        $response->assertOk();
        $response->assertViewIs('products.shop');
    }
}
