<?php

namespace Tests\Feature\Actions\Products;

use App\Product;
use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\TestHelpers;

class adminActionsOnProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
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
        $product = factory(Product::class)->create();

        // Act
        $this->actingAs($admin);
        $response = $this->get(route($route, $product));

        // Asserts
        $response->assertOk();
        $response->assertViewIs($route);

        // Asserts - Index
        if (strpos($route, 'index')) {
            $response->assertSee(trans('products.titles.index'));
            $response->assertViewHas('products');
            $responseProducts = $response->getOriginalContent()['products'];
            $this->assertTrue($responseProducts->contains($product));
        }
        // Asserts - Create
        if (strpos($route, 'create')) {
            $response->assertSee(trans('products.titles.create'));
        }
        // Asserts - Show && Edit
        if (strpos($route, 'show') || strpos($route, 'edit')) {
            $response->assertViewHas('product');
            $responseProduct = $response->getOriginalContent()['product']->toArray();
            unset($responseProduct['stats']);
            $this->assertDatabaseHas('products', TestHelpers::removeTimeKeys($responseProduct));
        }
    }

    // PROVIDER

    public function validActionsProvider() : array
    {
        return [
            'ViewAny' => ['products.index'],
            'Create' => ['products.create'],
            'View' => ['products.show'],
            'Edit' => ['products.edit'],
        ];
    }
}
