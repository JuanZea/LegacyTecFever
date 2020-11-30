<?php

namespace Tests\Feature\Products;

use App\Product;
use App\Report;
use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class reportsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function the_view_of_a_product_is_counted()
    {
        // Arrange
        $user = factory(User::class)->create();
        $products = factory(Product::class)->times(29)->create();
        $product = $products[rand(0,28)];
        factory(Report::class)->create(['assigned_to' => $product->id]);

        // Act
        $this->actingAs($user);
        $this->get(route('products.show', $product));
        $this->get(route('products.show', $product));
        $this->get(route('products.show', $product));
        $this->get(route('products.show', $product));

        // Assert
        $this->assertDatabaseHas('reports',['views' => 4]);
    }

//    /**
//     * @test
//     */
//    public function the_sale_of_a_product_is_counted()
//    {
//        // Arrange
//        $user1 = factory(User::class)->create();
//        $user2 = factory(User::class)->create();
//        $products = factory(Product::class)->times(29)->create();
//        $product = $products[rand(0,28)];
//        factory(ShoppingCart::class)->create(['user_id' => $user1->id]);
//        factory(ShoppingCart::class)->create(['user_id' => $user2->id]);
//        factory(Report::class)->create(['assigned_to' => $product->id]);
//
//        // Act
//        $this->actingAs($user1);
//        $this->post(route('shoppingCarts.store', ['product_id' => $product->id]));
//        $this->post(route('payment', ['shopping_cart_id' => $user1->shoppingCart->id]));
//        $this->actingAs($user2);
//        $this->post(route('shoppingCarts.store', ['product_id' => $product->id]));
//        $this->post(route('payment', ['shopping_cart_id' => $user2->shoppingCart->id]));
//        $this->get(route('products.show', $product));
//        $this->get(route('products.show', $product));
//        $this->get(route('products.show', $product));
//
//        // Assert
//        $this->assertDatabaseHas('reports',['views' => 4]);
//    }
}
