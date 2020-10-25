<?php

namespace Tests\Feature\Products;

use App\Product;
use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\TestHelpers;

class deleteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Check if an admin can delete a product
     *
     * @test
     */
    public function anAdminCanDeleteAProduct()
    {
        $this->withoutExceptionHandling();
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        factory(ShoppingCart::class)->create(['user_id' => $admin->id]);
        $product = factory(Product::class)->create();
        $data = TestHelpers::removeTimeKeys($product->toArray());

        // Act
        $this->actingAs($admin);
        $response = $this->delete(route('products.destroy', $product));

        // Assert
        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseMissing('products', $data);
    }

    /**
     * Verify that an user cannot delete a product
     *
     * @test
     */
    public function anUserCannotDeleteAProduct()
    {
        // Arrange
        $user = factory(User::class)->create();
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);
        $product = factory(Product::class)->create();
        $data = TestHelpers::removeTimeKeys($product->toArray());

        // Act
        $this->actingAs($user);
        $response = $this->delete(route('products.destroy', $product));

        // Assert
        $response->assertRedirect();
        $this->assertDatabaseHas('products', $data);
    }

    /**
     * Verify that a guest cannot delete a product
     *
     * @test
     */
    public function aGuestCannotDeleteAProduct()
    {
        // Arrange
        $product = factory(Product::class)->create();
        $data = TestHelpers::removeTimeKeys($product->toArray());

        // Act
        $response = $this->delete(route('products.destroy', $product));

        // Assert
        $response->assertRedirect('login');
        $this->assertDatabaseHas('products', $data);
    }
}
