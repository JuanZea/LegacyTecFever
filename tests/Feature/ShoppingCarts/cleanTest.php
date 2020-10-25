<?php

namespace Tests\Feature\ShoppingCarts;

use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class cleanTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @test
     * @return void
     */
    public function anUserCanCleanTheirShoppingCart()
    {
        // Arrange
        $user = factory(User::class)->create(['isEnabled' => true]);
        $shoppingCart = factory(ShoppingCart::class)->create([
            'user_id' => $user->id,
            'amount' => 15,
            'totalPrice' => 29000
        ]);

        // Act
        $this->actingAs($user);
        $response = $this->patch(route('shoppingCarts.clean', $shoppingCart));

        // Asserts
        $response->assertRedirect(route('shoppingCarts.show', $shoppingCart));
        $this->assertDatabaseMissing('shopping_carts', [
            'user_id' => $user->id,
            'amount' => 15,
            'totalPrice' => 29000
        ]);
    }
}
