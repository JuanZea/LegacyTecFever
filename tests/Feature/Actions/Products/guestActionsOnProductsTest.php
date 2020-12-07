<?php

namespace Tests\Feature\Actions\Products;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class guestActionsOnProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Check if the admin actions are forbidden on products
     * @test
     * @dataProvider invalidActionsProvider
     * @param string $route
     * @return void
     */
    public function aGuestCannot(string $route) : void
    {
        // Arrange
        $product = factory(Product::class)->create();

        // Act
        $response = $this->get(route($route, $product));

        // Assert
        $response->assertRedirect('login');
    }

    // PROVIDER

    public function invalidActionsProvider() : array
    {
        return [
            'index' => ['products.index'],
            'create' => ['products.create'],
            'show' => ['products.show'],
            'edit' => ['products.edit'],
        ];
    }
}
