<?php

namespace Tests\Feature\Guest;

use App\User;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\TestHelpers;

include_once 'tests/TestHelpers.php';

class guestActionsTest extends TestCase
{
    use RefreshDatabase;

    // use WithoutMiddleware;

    /**
     * Check if the guest actions are forbidden on users
     * @test
     * @dataProvider invalidGuestActionsOnUsersDataProvider
     * @param string $route
     * @param string $method
     */
    public function forUsersAGuestCannot($route,$method)
    {
         // Arrange
        $user = factory(User::class)->create();

        // Act
        $response = $this->$method(route($route,$user),TestHelpers::VALIDREQUESTFORUSER);

        // Assert
        $response->assertRedirect('login');
    }

    /**
     * Check if the guest actions are forbidden on products
     * @test
     * @dataProvider invalidGuestActionsOnProductsDataProvider
     * @param string $route
     * @param string $method
     */
    public function forProductsAGuestCannot($route,$method)
    {
         // Arrange
        $product = factory(Product::class)->create();

        // Act
        $response = $this->$method(route($route,$product));

        // Assert
        $response->assertRedirect('login');
    }

    public function invalidGuestActionsOnUsersDataProvider() : array
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

    public function invalidGuestActionsOnProductsDataProvider() : array
    {
        return [
            'index' => ['products.index', 'get'],
            'create' => ['products.create', 'get'],
            'store' => ['products.store', 'post'],
            'show' => ['products.show', 'get'],
            'edit' => ['products.edit', 'get'],
            'update' => ['products.update', 'put'],
            // 'delete' => ['products.delete', 'post'],
        ];
    }
}
