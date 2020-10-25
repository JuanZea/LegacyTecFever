<?php

namespace Tests\Feature\Actions\Users;

use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class guestTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Check if the guest actions are forbidden on users
     * @test
     * @dataProvider invalidActionsProvider
     * @param string $route
     * @return void
     */
    public function aGuestCannot(string $route) : void
    {
        // Arrange
        $user = factory(User::class)->create();
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);

        // Act
        $response = $this->get(route($route, $user));

        // Assert
        $response->assertRedirect('login');
    }

    // PROVIDER

    public function invalidActionsProvider() : array
    {
        return [
            'index' => ['users.index'],
//            'create' => ['users.create'],
            'show' => ['users.show'],
            'edit' => ['users.edit'],
        ];
    }
}
