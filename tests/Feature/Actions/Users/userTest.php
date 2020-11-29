<?php

namespace Tests\Feature\Actions\Users;

use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class userTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Check if the user actions are forbidden on users
     * @test
     * @dataProvider invalidActionsProvider
     * @param string $route
     * @return void
     */
    public function aGuestCannot(string $route) : void
    {
        // Arrange
        $user = factory(User::class)->create(['is_enabled' => true]);
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);
        $user2 = factory(User::class)->create(['is_enabled' => true]);
        factory(ShoppingCart::class)->create(['user_id' => $user2->id]);

        // Act
        $this->actingAs($user);
        $response = $this->get(route($route, $user2));

        // Assert
        $response->assertRedirect();
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
