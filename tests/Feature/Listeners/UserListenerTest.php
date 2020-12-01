<?php

namespace Tests\Feature\Listeners;

use App\Events\ProductCreated;
use App\Product;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

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
        $user = factory(User::class)->create();
        Event::fake();


        // Assert
        Event::assertDispatched(Registered::class);
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
        factory(Product::class)->create();

        // Assert
        Event::assertDispatched(ProductCreated::class);

    }
}
