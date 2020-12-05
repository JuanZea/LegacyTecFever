<?php

namespace Tests\Feature;

use App\Helpers\Detectors;
use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MostViewedProductsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The most epic test ever written
     *
     * @return void
     * @test
     */
    public function the5MostViewedAreSelectedWithWinner() : void
    {
        // Arrange
        $most5 = factory(Product::class)->create(['stats' => '{"views": 11}']);
        factory(Product::class)->create(['stats' => '{"views": 8}']);
        factory(Product::class)->create(['stats' => '{"views": 6}']);
        $most2 = factory(Product::class)->create(['stats' => '{"views": 27}']);
        factory(Product::class)->create(['stats' => '{"views": 1}']);
        $most3 = factory(Product::class)->create(['stats' => '{"views": 24}']);
        factory(Product::class)->create(['stats' => '{"views": 3}']);
        $most1 = factory(Product::class)->create(['stats' => '{"views": 29}']);
        factory(Product::class)->create(['stats' => '{"views": 0}']);
        $most4 = factory(Product::class)->create(['stats' => '{"views": 15}']);

        $products = Product::all()->toArray();

        // Acts
        $most_viewed_products = Detectors::most_viewed_products($products, []);

        // Asserts
        $this->assertEquals($most_viewed_products, [
            $most1->toArray(), $most2->toArray(), $most3->toArray(), $most4->toArray(), $most5->toArray(), true
        ]);
    }

    /**
     * The most epic test ever written
     *
     * @return void
     * @test
     */
    public function the5MostViewedAreSelectedWithoutWinner() : void
    {
        // Arrange
        $most5 = factory(Product::class)->create(['stats' => '{"views": 11}']);
        factory(Product::class)->create(['stats' => '{"views": 8}']);
        factory(Product::class)->create(['stats' => '{"views": 6}']);
        $most1 = factory(Product::class)->create(['stats' => '{"views": 29}']);
        factory(Product::class)->create(['stats' => '{"views": 1}']);
        $most3 = factory(Product::class)->create(['stats' => '{"views": 24}']);
        factory(Product::class)->create(['stats' => '{"views": 3}']);
        $most2 = factory(Product::class)->create(['stats' => '{"views": 29}']);
        factory(Product::class)->create(['stats' => '{"views": 0}']);
        $most4 = factory(Product::class)->create(['stats' => '{"views": 15}']);

        $products = Product::all()->toArray();

        // Acts
        $most_viewed_products = Detectors::most_viewed_products($products, []);

        // Asserts
        $this->assertEquals($most_viewed_products, [
            $most1->toArray(), $most2->toArray(), $most3->toArray(), $most4->toArray(), $most5->toArray(), false
        ]);
    }
}
