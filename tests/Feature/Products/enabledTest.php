<?php

namespace Tests\Feature\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class enabledTest extends TestCase
{
    // Tests the behavior of an enabled and disabled product.
    /**
     * Check the behavior of an enabled product.
     *
     * @return void
     * @test
     */
    public function AnEnabledUserCanShowAnEnabledProduct()
    {
        // Arrange
        $user = factory(User::class)->create(['isEnabled' => true]);
        $product = factory(Product::class)->create(['isEnabled' => true]);

        // Act
        $this->actingAs($user);
        $response = $this->get(route('products.show',$product));

        // Asserts
        $response->assertOk();
        $response->assertViewIs('products.show');
    }

    /**
     * Check the behavior of an enabled product.
     *
     * @return void
     * @test
     */
    public function AnEnabledUserCannotShowAnDisabledProduct()
    {
        // Arrange
        $user = factory(User::class)->create(['isEnabled' => true]);
        $product = factory(Product::class)->create(['isEnabled' => false]);

        // Act
        $this->actingAs($user);
        $response = $this->get(route('products.show',$product));

        // Asserts
        $response->assertRedirect('home');
    }

    /**
     * Check the behavior of an enabled product.
     *
     * @return void
     * @test
     */
    public function AnEnabledUserCannotViewAnDisabledProductOnShop()
    {
        // Arrange
        $user = factory(User::class)->create(['isEnabled' => true]);
        $product = factory(Product::class)->create(['isEnabled' => false]);

        // Act
        $this->actingAs($user);
        $response = $this->get(route('products.shop',['name'=>$product->name]));

        // Asserts
        $response->assertOk();
        $response->assertSee(__('There are no products to show'), $escaped = true);
    }
}
