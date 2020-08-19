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
    public function AnEnabledUserCanViewAnEnabledProduct()
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
    public function AnEnabledUserCannotViewAnDisabledProduct()
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
}
