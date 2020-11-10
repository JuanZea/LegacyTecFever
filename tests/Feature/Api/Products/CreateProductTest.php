<?php

namespace Tests\Feature\Api\Products;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function testExample()
    {
        $product = factory(Product::class)->raw();

        $response = $this->postJson(route('api.products.create'), $product);

        $response->assertStatus(200);
    }
}
