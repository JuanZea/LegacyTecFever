<?php

namespace Tests\Feature\Products;

use App\Events\ProductViewed;
use App\Product;
use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class statsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function the_view_of_a_product_is_counted()
    {
        Event::fake();
        $this->withoutExceptionHandling();
        // Arrange
        $user = factory(User::class)->create();
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);
        $products = factory(Product::class)->times(1)->create();
//        $products = factory(Product::class)->times(29)->create();
        $product = $products[0];
//        $product = $products[rand(0,28)];

        // Act
        $this->actingAs($user);
        $this->get(route('products.show', $product));
        $this->get(route('products.show', $product));
        $this->get(route('products.show', $product));
        $this->get(route('products.show', $product));

        // Assert
        $stats = \GuzzleHttp\json_decode($product->stats, true);
        Event::assertDispatched(ProductViewed::class);
//        dd($stats, $product);
//        $this->assertTrue(in_array(['views' => 4], $stats));
//        $this->assertDatabaseHas('products', ['stats' => '{"views": 4}']);
    }
}
