<?php

namespace Tests\Feature\Listeners;

use App\Events\ProductCreated;
use App\Product;
use App\ShoppingCart;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Tests\TestHelpers;

class UserListenerTest extends TestCase
{
    use RefreshDatabase;

    public function teste()
    {
        $this->assertTrue(true);
    }
    /**
     *
     */
    public function a_shopping_cart_is_assigned_to_a_user()
    {
        // Arrange
        TestHelpers::activeRoles();
        Event::fake();
        $user = factory(User::class)->create()->assignRole('user');


        // Assert
//        Event::assertDispatched(Registered::class);
        $this->assertDatabaseHas('shopping_carts', [
            'user_id' => $user->id
        ]);
    }

    /**
     *
     */
    public function a_report_is_assigned_to_a_product()
    {
        // Arrange
        Event::fake();
        $admin = factory(User::class)->create(['is_admin' => true]);
        $product = factory(Product::class)->raw();

        // Act
        $this->actingAs($admin);
        $this->post(route('products.store'), $product);

        // Assert
        Event::assertDispatched(ProductCreated::class);
    }
}
