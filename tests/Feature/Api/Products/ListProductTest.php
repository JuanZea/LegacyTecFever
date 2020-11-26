<?php

namespace Tests\Feature\Api\Products;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListProductTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function canFetchSingleProduct()
    {
        // Arrange
        $product = factory(Product::class)->create(['isEnabled' => rand(0, 1)]);

        // Act
        $response = $this->getJson(route('api.products.show', $product));

        // Assert
        $response->assertExactJson([
            'data' => [
                'type' => 'products',
                'id' => (String) $product->id,
                'attributes' => [
                    'name' => $product->name,
                    'isEnabled' => $product->isEnabled,
                    'description' => $product->description,
                    'category' => $product->category,
                    'image' => $product->getImage,
                    'price' => $product->price
                ],
                'links' => [
                    'self' => url(route('api.products.show', $product)),
                ]
            ]
        ]);

        $response->assertOk();
    }

    /**
     * @test
     */
    public function canFetchAllProduct()
    {
        // Arrange
        $products = factory(Product::class)->times(3)->create(['isEnabled' => rand(0, 1)]);

        // Act
        $response = $this->getJson(route('api.products.index'));

        // Assert
        $response->assertJson([
            'data' => [
                [
                    'type' => 'products',
                    'id' => (String) $products[0]->id,
                    'attributes' => [
                        'name' => $products[0]->name,
                        'isEnabled' => $products[0]->isEnabled,
                        'description' => $products[0]->description,
                        'category' => $products[0]->category,
                        'image' => $products[0]->getImage,
                        'price' => $products[0]->price
                    ],
                    'links' => [
                        'self' => url(route('api.products.show', $products[0]))
                    ]
                ],
                [
                    'type' => 'products',
                    'id' => (String) $products[1]->id,
                    'attributes' => [
                        'name' => $products[1]->name,
                        'isEnabled' => $products[1]->isEnabled,
                        'description' => $products[1]->description,
                        'category' => $products[1]->category,
                        'image' => $products[1]->getImage,
                        'price' => $products[1]->price
                    ],
                    'links' => [
                        'self' => url(route('api.products.show', $products[1])),
                    ]
                ],
                [
                    'type' => 'products',
                    'id' => (String) $products[2]->id,
                    'attributes' => [
                        'name' => $products[2]->name,
                        'isEnabled' => $products[2]->isEnabled,
                        'description' => $products[2]->description,
                        'category' => $products[2]->category,
                        'image' => $products[2]->getImage,
                        'price' => $products[2]->price
                    ],
                    'links' => [
                        'self' => url(route('api.products.show', $products[2])),
                    ]
                ]
            ],
        ]);

        $response->assertOk();
    }
}
