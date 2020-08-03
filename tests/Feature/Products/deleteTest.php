<?php

namespace Tests\Feature\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class deleteTest extends TestCase
{
    /**
     * Tests for delete Products
     *
     * @test
     */
    public function anAdminCanDeleteAProduct()
    {
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        $product = factory(Product::class)->create();
        $data = removeTimeKeys($product->toArray());
        // dd($data);

        // Act
        $this->actingAs($admin);
        $response = $this->delete(route('products.destroy',$product));

        // Assert
        $response->assertOk();
        // $response->assertViewIs('products.index');
        $this->assertDatabaseMissing('products', $data);
    }
}
