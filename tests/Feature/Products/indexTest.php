<?php

namespace Tests\Feature\Products;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class indexTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Tests for index of Products
     *
     * @test
     */
    public function anAdminCanListProducts()
    {
        // Arrange
        $user = factory(User::class)->create(['isAdmin' => true]);

        // Act
        $this->actingAs($user);
        $response = $this->get(route('products.index'));

        // Assert
        $response->assertOk();
        $response->assertViewIs('products.index');
        $response->assertViewHas('products');
    }

     /**
     * Tests for index of Products
     *
     * @test
     */
    public function anUserCannotListProducts()
    {
        // Arrange
        $user = factory(User::class)->create(['isAdmin' => false]);

        // Act
        $this->actingAs($user);
        $response = $this->get(route('products.index'));

        // Assert
        $response->assertRedirect();
    }

    /**
     * Tests for index of Products
     *
     * @test
     */
    public function anGuestCannotListProducts()
    {
        // Act
        $response = $this->get(route('products.index'));

        // Assert
        $response->assertRedirect('login');
    }
}
