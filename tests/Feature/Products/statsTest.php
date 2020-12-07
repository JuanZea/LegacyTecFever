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
use Tests\TestHelpers;

class statsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function the_view_of_a_product_is_counted()
    {
        TestHelpers::activeRoles();
        Event::fake();
        $this->withoutExceptionHandling();
        // Arrange
        $user = factory(User::class)->create()->assignRole('user');
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
//        $this->assertDatabaseHas('products', ['stats' => '{"sales": 0, "views": 4}']);
    }
}
