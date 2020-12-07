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

    private $product;

    public function setUp(): void
    {
        parent::setUp();
        TestHelpers::activeRoles();
        $this->product = factory(Product::class)->create();
    }

    /**
     * Verify that a guest cannot delete a product
     *
     * @test
     */
    public function aGuestCannotDeleteAProduct()
    {
        // Arrange
        $data = TestHelpers::removeTimeKeys($this->product->toArray());
        unset($data['stats']);

        // Act
        $response = $this->delete(route('products.destroy', $this->product));

        // Assert
        $response->assertRedirect('login');
        $this->assertDatabaseHas('products', $data);
    }

    /**
     * Verify that an user cannot delete a product
     *
     * @test
     */
    public function anUserCannotDeleteAProduct()
    {
        // Arrange
        $user = factory(User::class)->create()->assignRole('user');
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);
        $data = TestHelpers::removeTimeKeys($this->product->toArray());
        unset($data['stats']);

        // Act
        $this->actingAs($user);
        $response = $this->delete(route('products.destroy', $this->product));

        // Assert
        $response->assertStatus(403); // Forbidden
        $this->assertDatabaseHas('products', $data);
    }

    /**
     * Check if an admin can delete a product
     *
     * @test
     */
    public function anAdminCanDeleteAProduct()
    {
        $this->withoutExceptionHandling();
        // Arrange
        $admin = factory(User::class)->create()->assignRole('admin');
        factory(ShoppingCart::class)->create(['user_id' => $admin->id]);
        $data = TestHelpers::removeTimeKeys($this->product->toArray());

        // Act
        $this->actingAs($admin);
        $response = $this->delete(route('products.destroy', $this->product));

        // Assert
        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseMissing('products', $data);
    }
}
