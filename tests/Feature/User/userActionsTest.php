<?php

namespace Tests\Feature\User;

use App\User;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\TestHelpers;

class userActionsTest extends TestCase
{
    use RefreshDatabase;

    // use WithoutMiddleware;

    /**
     * Check if the enabled user actions are forbidden on users
     * @test
     * @dataProvider invalidEnabledUserActionsOnUsersDataProvider
     * @param string $route
     * @param string $method
     */
    public function forUsersAEnabledUserCannot($route,$method)
    {
         // Arrange
        $user = factory(User::class)->create(['isEnabled'=>true]);
        $user2 = factory(User::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->$method(route($route,$user2), TestHelpers::VALIDREQUESTFORUSER);

        // Assert
        $response->assertRedirect();
    }

    /**
     * Check if the disabled user actions are forbidden on users
     * @test
     * @dataProvider invalidDisabledUserActionsOnUsersDataProvider
     * @param string $route
     * @param string $method
     */
    public function forUsersADisabledUserCannot($route,$method)
    {
         // Arrange
        $user = factory(User::class)->create(['isEnabled'=>false]);
        $user2 = factory(User::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->$method(route($route,$user2), TestHelpers::VALIDREQUESTFORUSER);

        // Assert
        $response->assertRedirect();
    }

    /**
     * Check if the enabled user actions are allowed on enabled products
     * @test
     * @dataProvider validEnabledUserActionsOnEnabledProductsDataProvider
     * @param string $route
     * @param string $method
     */
    public function forEnabledProductsAEnabledUserCan($route,$method)
    {
         // Arrange
        $user = factory(User::class)->create(['isEnabled'=>true]);
        $product = factory(Product::class)->create(['isEnabled'=>true]);

        // Act
        $this->actingAs($user);
        $response = $this->$method(route($route,$product),TestHelpers::VALIDREQUESTFORPRODUCT);

        // Assert
        $response->assertOk();
        $response->assertViewIs($route);
    }

    /**
     * Check if the enabled user actions are forbidden on enabled products
     * @test
     * @dataProvider invalidEnabledUserActionsOnEnabledProductsDataProvider
     * @param string $route
     * @param string $method
     */
    public function forEnabledProductsAEnabledUserCannot($route,$method)
    {
         // Arrange
        $user = factory(User::class)->create(['isEnabled'=>true]);
        $product = factory(Product::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->$method(route($route,$product));

        // Assert
        $response->assertRedirect();
    }

    /**
     * Check if the disabled user actions are forbidden on enabled products
     * @test
     * @dataProvider invalidEnabledUserActionsOnEnabledProductsDataProvider
     * @param string $route
     * @param string $method
     */
    public function forEnabledProductsADisabledUserCannot($route,$method)
    {
         // Arrange
        $user = factory(User::class)->create(['isEnabled'=>false]);
        $product = factory(Product::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->$method(route($route,$product));

        // Assert
        $response->assertRedirect();
    }

    public function invalidEnabledUserActionsOnUsersDataProvider() : array
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

    public function invalidDisabledUserActionsOnUsersDataProvider() : array
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

    public function validEnabledUserActionsOnEnabledProductsDataProvider() : array
    {
        return [
            'show' => ['products.show', 'get'],
        ];
    }

    public function invalidEnabledUserActionsOnEnabledProductsDataProvider() : array
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
