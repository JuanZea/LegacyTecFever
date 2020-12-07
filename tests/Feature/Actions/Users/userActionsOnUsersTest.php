<?php

namespace Tests\Feature\Actions\Users;

use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\TestHelpers;

class userActionsOnUsersTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        TestHelpers::activeRoles();
        $this->user = factory(User::class)->create(['is_enabled' => true])->assignRole('user');
        factory(ShoppingCart::class)->create(['user_id' => $this->user->id]);
    }

    /**
     * Check if the user actions are forbidden on users
     * @test
     * @dataProvider invalidActionsProvider
     * @param string $route
     * @return void
     */
    public function aUserCannot(string $route) : void
    {
        // Arrange
        $other_user = factory(User::class)->create(['is_enabled' => true])->assignRole('user');
        factory(ShoppingCart::class)->create(['user_id' => $other_user->id]);

        // Act
        $this->actingAs($this->user);
        $response = $this->get(route($route, $other_user));

        // Assert
        $response->assertStatus(403); // Forbidden
    }

    // PROVIDER

    public function invalidActionsProvider() : array
    {
        return [
            'ViewAny' => ['users.index'],
//            'create' => ['users.create'],
            'View' => ['users.show'],
            'Edit' => ['users.edit'],
        ];
    }
}
