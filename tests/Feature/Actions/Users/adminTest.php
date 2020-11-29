<?php

namespace Tests\Feature\Actions\Users;

use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\TestHelpers;

class adminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Check if the admin actions are allowed on users
     * @test
     * @dataProvider validActionsProvider
     * @param string $route
     * @return void
     */
    public function anAdminCan(string $route) : void
    {
         // Arrange
        $admin = factory(User::class)->create(['is_admin' => true,'is_enabled' => true]);
        factory(ShoppingCart::class)->create(['user_id' => $admin->id]);
        $user = factory(User::class)->create();
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);

        // Act
        $this->actingAs($admin);
        $response = $this->get(route($route, $user));

        // Assert
        $response->assertOk();
        $response->assertViewIs($route);
        if (strpos($route, 'index')) {
            $response->assertViewHas('users');
            $responseUsers = $response->getOriginalContent()['users'];
            $this->assertTrue($responseUsers->contains($user));
        }
        if (strpos($route, 'show') || strpos($route, 'edit')) {
            $response->assertViewHas('user');
            $responseUser = $response->getOriginalContent()['user']->toArray();
            $this->assertDatabaseHas('users', TestHelpers::removeTimeKeys($responseUser));
        }
    }

    // PROVIDERS

    public function validActionsProvider() : array
    {
        return [
            'index' => ['users.index'],
            // 'create' => ['users.create'],
            'show' => ['users.show'],
            'edit' => ['users.edit'],
        ];
    }
}
