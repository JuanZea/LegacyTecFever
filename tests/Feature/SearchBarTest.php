<?php

namespace Tests\Feature;

use App\Product;
use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchBarTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Check that a guest cannot search for products
     * @test
     */
    public function AGuestCannotSearchAProduct()
    {
        // Arrange
        $product = factory(Product::class)->create();

        // Act
        $response = $this->get(route('shop',['name' => $product->name]));

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
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);
        $product = factory(Product::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->get(route('shop',['name' => $product->name]));

        // Assert
        $response->assertOk();
        $response->assertViewIs('shop');
    }

    /**
     * Check that a admin can search for products
     * @test
     */
    public function AAdminCanSearchAProduct()
    {
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true,'isEnabled' => true]);
        factory(ShoppingCart::class)->create(['user_id' => $admin->id]);
        $product = factory(Product::class)->create();

        // Act
        $this->actingAs($admin);
        $response = $this->get(route('shop',['name' => $product->name]));

        // Assert
        $response->assertOk();
        $response->assertViewIs('shop');
    }
}
