<?php

namespace Tests\Feature\Products;

use App\Events\ProductViewed;
use App\Listeners\AssignView;
use App\Product;
use App\ShoppingCart;
use App\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;
use Tests\TestHelpers;

class statsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @throws BindingResolutionException
     */
    public function the_view_of_a_product_is_counted()
    {
        // Arrange
        TestHelpers::activeRoles();
        Event::fake();
        $listener = $this->app->make(AssignView::class);

        $user = factory(User::class)->create()->assignRole('user');
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);
        $product = factory(Product::class)->create(['is_enabled' => true]);


        // Act
        $this->actingAs($user);
        $listener->handle(new ProductViewed($product));
        $this->get(route('products.show', $product));
        $listener->handle(new ProductViewed($product));
        $this->get(route('products.show', $product));
        $listener->handle(new ProductViewed($product));
        $this->get(route('products.show', $product));
        $listener->handle(new ProductViewed($product));
        $this->get(route('products.show', $product));

        // Asserts
        $stats = \GuzzleHttp\json_decode($product->stats, true);
        Event::assertDispatched(ProductViewed::class, 4);
        $this->assertEquals(4, $stats['views']);
    }
}
