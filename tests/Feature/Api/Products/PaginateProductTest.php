<?php

namespace Tests\Feature\Api\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\TestHelpers;

class PaginateProductTest extends TestCase
{
    use RefreshDatabase;

    public function test()
    {
        $this->assertTrue(true);
    }

    /**
     *
     */
    public function canFetchPaginatedProducts()
    {
        // Arrange
        TestHelpers::activeRoles();
        $admin = factory(User::class)->create(['is_enabled' => true])->assignRole('admin');
        $products = factory(Product::class)->times(30)->create(['is_enabled' => rand(0, 1)]);

        // Act
        $response = $this->getJson(route('api.products.index', ['api_token' => $admin->api_token, 'page[size]' => 3, 'page[number]' => 2]));

        // Assert
        $response->assertJsonCount(3, 'data');

        $response->assertDontSee($products[0]->name);
        $response->assertDontSee($products[1]->name);
        $response->assertDontSee($products[2]->name);
        $response->assertSee($products[3]->name);
        $response->assertSee($products[4]->name);
        $response->assertSee($products[5]->name);
        $response->assertDontSee($products[6]->name);
        $response->assertDontSee($products[7]->name);
        $response->assertDontSee($products[8]->name);
        $response->assertDontSee($products[9]->name);

        $response->assertJsonStructure([
            'links' => ['first', 'last', 'prev', 'next']
        ]);

        $response->assertJsonFragment([
            'first' => route('api.products.index', ['page[size]' => 3, 'page[number]' => 1]),
            'last' => route('api.products.index', ['page[size]' => 3, 'page[number]' => 10]),
            'prev' => route('api.products.index', ['page[size]' => 3, 'page[number]' => 1]),
            'next' => route('api.products.index', ['page[size]' => 3, 'page[number]' => 3])
        ]);
    }
}
