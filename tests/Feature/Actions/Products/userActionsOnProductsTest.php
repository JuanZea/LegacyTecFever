<?php

namespace Tests\Feature\Actions\Products;

use App\Product;
use App\Report;
use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\TestHelpers;

class userActionsOnProductsTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $enabled_product;
    private $disabled_product;

    public function setUp(): void
    {
        parent::setUp();
        TestHelpers::activeRoles();
        $this->user = factory(User::class)->create(['is_enabled' => true])->assignRole('user');
        factory(ShoppingCart::class)->create(['user_id' => $this->user->id]);
        $this->enabled_product = factory(Product::class)->create(['is_enabled' => true]);
        $this->disabled_product = factory(Product::class)->create(['is_enabled' => false]);
    }

    /**
     * @test
     * @dataProvider validActionsProvider
     * @param string $route
     * @return void
     */
    public function anUserCan(string $route) : void
    {
        // Act
        $this->actingAs($this->user);
        $response = $this->get(route($route, $this->enabled_product));

        // Asserts
        $response->assertOk();
        $response->assertViewIs($route);
        $response->assertViewHas('product');
        $responseProduct = $response->getOriginalContent()['product']->toArray();
        unset($responseProduct['stats']);
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
        // Act
        $this->actingAs($this->user);
        $response = $this->get(route($route, $this->disabled_product));

        // Asserts
        if ($route == 'products.show') {
            $response->assertViewIs('errors.disabled_product');
        } else {
            $response->assertStatus(403); // Forbidden
        }
    }

    // PROVIDER

    public function validActionsProvider() : array
    {
        return [
            'ViewEnabledProduct' => ['products.show']
        ];
    }

    public function invalidActionsProvider() : array
    {
        return [
            'ViewAny' => ['products.index'],
            'Create' => ['products.create'],
            'ViewDisabledProduct' => ['products.show'],
            'Edit' => ['products.edit'],
        ];
    }
}
