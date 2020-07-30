<?php

namespace Tests\Feature\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class editTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests for edit Products
     *
     * @test
     */
    public function anAdminCanEditProducts()
    {
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        $product = factory(Product::class)->create();

        // Act
        $this->actingAs($admin);
        $response = $this->get(route('products.edit',$product));

        // Assert
        $response->assertOk();
        $response->assertViewIs('products.edit');
        $response->assertViewHas('product');
        $responseProduct = $response->getOriginalContent()['product']->toArray();
        $this->assertDatabaseHas('products',removeTimeKeys($responseProduct));
    }

    /**
     * Tests for edit Product
     *
     * @test
     */
    public function anUserCannotEditUsers()
    {
        // Arrange
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->get(route('products.edit',$product));

        // Assert
        $response->assertRedirect();
    }

    /**
     * Tests for edit Product
     *
     * @test
     */
    public function anGuestCannotEditUsers()
    {
        // Arrange
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        // Act
        $response = $this->get(route('products.edit',$product));

        // Assert
        $response->assertRedirect('login');
    }
}
