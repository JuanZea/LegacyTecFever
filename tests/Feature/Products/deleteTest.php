<?php

namespace Tests\Feature\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tests\TestHelpers;

class deleteTest extends TestCase
{
    /**
     * Tests for delete Products
     *
     * @test
     */
    public function anAdminCanDeleteAProduct()
    {
        $this->WithoutExceptionHandling();
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        $product = factory(Product::class)->create();
        $data = TestHelpers::removeTimeKeys($product->toArray());

        // Act
        $this->actingAs($admin);
        $response = $this->delete(route('products.destroy',$product));

        // Assert
        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseMissing('products', $data);
    }
}
