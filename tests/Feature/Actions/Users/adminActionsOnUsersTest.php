<?php

namespace Tests\Feature\Actions\Users;

use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\TestHelpers;

class adminActionsOnUsersTest extends TestCase
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
        TestHelpers::activeRoles();
        $admin = factory(User::class)->create(['is_enabled' => true])->assignRole('admin');
        factory(ShoppingCart::class)->create(['user_id' => $admin->id]);
        $user = factory(User::class)->create()->assignRole('user');
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);

        // Act
        $this->actingAs($admin);
        $response = $this->get(route($route, $user));

        // Asserts
        $response->assertOk();
        $response->assertViewIs($route);
        // Asserts - Index
        if (strpos($route, 'index')) {
            $response->assertViewHas('users');
            $responseUsers = $response->getOriginalContent()['users'];
            $this->assertTrue($responseUsers->contains($user));
        }
        // Asserts - Show && Edit
        if (strpos(strpos($route, 'show') || $route, 'edit')) {
            $response->assertViewHas('user');
            $responseUser = $response->getOriginalContent()['user']->toArray();
            unset($responseUser['roles']);
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
