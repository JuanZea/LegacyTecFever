<?php

namespace Tests\Feature\Products;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class createTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests for create Products
     *
     * @test
     */
    public function anAdminCanCreateAProduct()
    {
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);

        // Act
        $this->actingAs($admin);
        $response = $this->get(route('products.create'));

        // Assert
        $response->assertOk();
        $response->assertViewIs('products.create');
    }

    /**
     * Tests for create Products
     *
     * @test
     */
    public function anUserCannotCreateAProduct()
    {
        // Arrange
        $user = factory(User::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->get(route('products.create'));

        // Assert
        $response->assertRedirect();
    }

    /**
     * Tests for create Products
     *
     * @test
     */
    public function anGuestCannotCreateAProduct()
    {
        // Act
        $response = $this->get(route('products.create'));

        // Assert
        $response->assertRedirect('login');
    }
}
