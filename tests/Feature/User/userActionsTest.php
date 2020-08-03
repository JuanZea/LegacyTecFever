<?php

namespace Tests\Feature\User;

use App\User;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
include_once 'tests/TestHelpers.php';

class userActionsTest extends TestCase
{
    use RefreshDatabase;

    // use WithoutMiddleware;

    /**
     * Check if the user actions are forbidden on users
     * @test
     * @dataProvider invalidUserActionsOnUsersDataProvider
     * @param string $route
     * @param string $method
     */
    public function forUsersAUserCannot($route,$method)
    {
         // Arrange
        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->$method(route($route,$user2),VALIDREQUESTFORUSER);

        // Assert
        $response->assertRedirect();
    }

    /**
     * Check if the user actions are allowed on products
     * @test
     * @dataProvider validUserActionsOnProductsDataProvider
     * @param string $route
     * @param string $method
     */
    public function forProductsAUserCan($route,$method)
    {
         // Arrange
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->$method(route($route,$product),VALIDREQUESTFORPRODUCT);

        // Assert
        $response->assertOk();
        $response->assertViewIs($route);
    }

    /**
     * Check if the user actions are forbidden on products
     * @test
     * @dataProvider invalidUserActionsOnProductsDataProvider
     * @param string $route
     * @param string $method
     */
    public function forProductsAUserCannot($route,$method)
    {
         // Arrange
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->$method(route($route,$product));

        // Assert
        $response->assertRedirect();
    }

    public function invalidUserActionsOnUsersDataProvider() : array
    {
        return [
            'index' => ['users.index', 'get'],
            'create' => ['users.create', 'get'],
            'store' => ['users.store', 'post'],
            'show' => ['users.show', 'get'],
            'edit' => ['users.edit', 'get'],
            'update' => ['users.update', 'put'],
            // 'delete' => ['users.delete', 'post'],
        ];
    }

    public function validUserActionsOnProductsDataProvider() : array
    {
        return [
            'show' => ['products.show', 'get'],
        ];
    }

    public function invalidUserActionsOnProductsDataProvider() : array
    {
        return [
            'index' => ['products.index', 'get'],
            'create' => ['products.create', 'get'],
            'store' => ['products.store', 'post'],
            'edit' => ['products.edit', 'get'],
            'update' => ['products.update', 'put'],
            // 'delete' => ['products.delete', 'post'],
        ];
    }
}
