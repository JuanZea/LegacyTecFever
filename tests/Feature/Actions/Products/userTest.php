<?php

namespace Tests\Feature\Actions\Products;

use App\Product;
use App\Report;
use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\TestHelpers;

class userTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Check if the admin actions are allowed on products
     * @test
     * @dataProvider validActionsProvider
     * @param string $route
     * @return void
     */
    public function anUserCan(string $route) : void
    {
        // Arrange
        $user = factory(User::class)->create(['is_enabled' => true]);
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);
        $product = factory(Product::class)->create(['is_enabled' => true]);
        factory(Report::class)->create(['product_id' => $product->id]);

        // Act
        $this->actingAs($user);
        $response = $this->get(route($route, $product));

        // Assert
        $response->assertOk();
        $response->assertViewIs($route);
        $response->assertViewHas('product');
        $responseProduct = $response->getOriginalContent()['product']->toArray();
        unset($responseProduct['report']);
        $this->assertDatabaseHas('products', TestHelpers::removeTimeKeys($responseProduct));
    }

    /**
     * Check if the user actions are forbidden on products
     * @test
     * @dataProvider invalidActionsProvider
     * @param string $route
     * @return void
     */
    public function anUserCannot(string $route) : void
    {
        $this->withoutExceptionHandling();
        // Arrange
        $user = factory(User::class)->create(['is_enabled' => true]);
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);
        $product = factory(Product::class)->create(['is_enabled' => false]);
        factory(Report::class)->create(['product_id' => $product->id]);

        // Act
        $this->actingAs($user);
        $response = $this->get(route($route, $product));

        // Assert
        if ($route == 'products.show') {
            $response->assertViewIs('errors.disabled_product');
        } else {
            $response->assertRedirect();
        }
    }

    // PROVIDER

    public function validActionsProvider() : array
    {
        return [
            'showEnabledProduct' => ['products.show']
        ];
    }

    public function invalidActionsProvider() : array
    {
        return [
            'index' => ['products.index'],
            'create' => ['products.create'],
            'showDisabledProduct' => ['products.show'],
            'edit' => ['products.edit'],
        ];
    }
}
