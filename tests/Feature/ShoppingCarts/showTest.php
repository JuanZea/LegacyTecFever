<?php

namespace Tests\Feature\ShoppingCarts;

use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class showTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Check if a guest can not show a shopping cart
     *
     * @test
     * @return void
     */
    public function aGuestCannotAShoppingCart()
    {
        // Arrange
        $user = factory(User::class)->create(['is_enabled' => true]);
        $shoppingCart = factory(ShoppingCart::class)->create([
            'user_id' => $user->id
        ]);

        // Act
        $response = $this->get(route('shoppingCarts.show', $shoppingCart));

        // Asserts
        $response->assertRedirect('login');
    }

    /**
     * Check if an user can show their shopping cart
     *
     * @test
     * @return void
     */
    public function anUserCanShowTheirShoppingCart()
    {
        // Arrange
        $user = factory(User::class)->create(['is_enabled' => true]);
        $shoppingCart = factory(ShoppingCart::class)->create([
            'user_id' => $user->id
        ]);

        // Act
        $this->actingAs($user);
        $response = $this->get(route('shoppingCarts.show', $shoppingCart));

        // Asserts
        $response->assertOk()
            ->assertViewIs('shoppingCarts.show');
    }
}
