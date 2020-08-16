<?php

namespace Tests\Feature\Admin;

use App\User;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\TestHelpers;

include_once 'tests/TestHelpers.php';

class adminActionsTest extends TestCase
{
    use RefreshDatabase;

    // use WithoutMiddleware;

    /**
     * Check if the admin actions are allowed on users
     * @test
     * @dataProvider validAdminActionsOnUsersDataProvider
     * @param string $route
     */
    public function forUsersAAdminCan($route)
    {
         // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        $user = factory(User::class)->create();

        // Act
        $this->actingAs($admin);
        $response = $this->get(route($route,$user));

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
            $this->assertDatabaseHas('users',TestHelpers::removeTimeKeys($responseUser));
        }
    }

    /**
     * Check if the admin actions are allowed on products
     * @test
     * @dataProvider validAdminActionsOnProductsDataProvider
     * @param string $route
     */
    public function forProductsAAdminCan($route)
    {
         // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        $product = factory(Product::class)->create();

        // Act
        $this->actingAs($admin);
        $response = $this->get(route($route,$product));

        // Assert
        $response->assertOk();
        $response->assertViewIs($route);
        if (strpos($route, 'index')) {
            $response->assertViewHas('products');
            $responseProducts = $response->getOriginalContent()['products'];
            $this->assertTrue($responseProducts->contains($product));
        }
        if (strpos($route, 'show') || strpos($route, 'edit')) {
            $response->assertViewHas('product');
            $responseProduct = $response->getOriginalContent()['product']->toArray();
            $this->assertDatabaseHas('products',TestHelpers::removeTimeKeys($responseProduct));
        }
    }

    public function validAdminActionsOnUsersDataProvider() : array
    {
        return [
            'index' => ['users.index'],
            // 'create' => ['users.create'],
            'show' => ['users.show'],
            'edit' => ['users.edit'],
        ];
    }

    public function validAdminActionsOnProductsDataProvider() : array
    {
        return [
            'index' => ['products.index'],
            'create' => ['products.create'],
            'show' => ['products.show'],
            'edit' => ['products.edit'],
        ];
    }
}
