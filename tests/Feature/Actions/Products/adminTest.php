<?php

namespace Tests\Feature\Actions\Products;

use App\Product;
use App\Report;
use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\TestHelpers;

class adminTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Check if the admin actions are allowed on products
     * @test
     * @dataProvider validActionsProvider
     * @param string $route
     * @return void
     */
    public function anAdminCan(string $route) : void
    {
        $this->withoutExceptionHandling();
        // Arrange
        $admin = factory(User::class)->create(['is_admin' => true, 'is_enabled' => true]);
        factory(ShoppingCart::class)->create(['user_id' => $admin->id]);
        $product = factory(Product::class)->create();
        factory(Report::class)->create(['product_id' => $product->id]);

        // Act
        $this->actingAs($admin);
        $response = $this->get(route($route, $product));

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
            unset($responseProduct['report']);
            $this->assertDatabaseHas('products', TestHelpers::removeTimeKeys($responseProduct));
        }
    }

    // PROVIDER

    public function validActionsProvider() : array
    {
        return [
            'index' => ['products.index'],
            'create' => ['products.create'],
            'show' => ['products.show'],
            'edit' => ['products.edit'],
        ];
    }
}
