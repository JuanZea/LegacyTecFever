<?php

namespace Tests\Feature\Products;

use App\Product;
use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\TestHelpers;

class updateProductsTest extends TestCase
{
    use RefreshDatabase;

    private $admin;
    private $valid_product_request;

    public function setUp(): void
    {
        parent::setUp();
        TestHelpers::activeRoles();
        $this->valid_product_request = factory(Product::class)->raw();
        $this->admin = factory(User::class)->create(['is_enabled' => true])->assignRole('admin');
    }

    /**
     * Verify that an admin can update products with valid information
     *
     * @test
     * @dataProvider validProductInputDataProvider
     * @param string $data
     */
    public function anAdminCanUpdateProductsWithValidProductInputs(string $data)
    {
        $this->withoutExceptionHandling();
        // Arrange
        $product = factory(Product::class)->create();
        $oldData = TestHelpers::removeTimeKeys($product->toArray());
        unset($oldData['stats']);
        unset($oldData['is_enabled']);

        $validRequest = $this->valid_product_request;
        unset($validRequest['is_enabled']);

        if($data == 'same') {
            $validRequest = $oldData;
        }
        if ($data != 'new' && $data != 'same') {
            $validRequest[$data] = $oldData[$data];
        }

        // Act
        $this->actingAs($this->admin);
        $response = $this->put(route('products.update', $product), $validRequest);

        // Asserts
        $response->assertRedirect();
        $this->assertDatabaseHas('products', $validRequest);
        // Asserts - New Data
        if ($data == 'new') {
            $this->assertDatabaseMissing('products', $oldData);
        }
    }

     /**
     * Verify that an admin cannot update products with invalid information
     *
     * @test
     * @dataProvider invalidProductInputDataProvider
     * @param string $field
     * @param string|null $value
     */
    public function anAdminCannotUpdateProductWithInvalidUserInputs(string $field, ?string $value)
    {
        // Arrange
        $invalidRequest = $this->valid_product_request;
        $invalidRequest[$field] = $value;

        // Act
        $this->actingAs($this->admin);
        $response = $this->post(route('products.store', $invalidRequest));

        // Assert
        $response->assertRedirect();
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('products', $invalidRequest);
    }

    // PROVIDERS

    public function validProductInputDataProvider()
    {
        return [
            // All Data
            'New data' => ['new'],
            'Same data' => ['same'],

            // Inputs
            'Same name' => ['name'],
            'Same description' => ['description'],
            'Same category' => ['category'],
            'Same image' => ['image'],
            'Same price' => ['price'],
            'Same stock' => ['stock']
        ];
    }

    public function invalidProductInputDataProvider()
    {
        return [
            'No name' => ['name', null],
            'A name too short' => ['name', Str::random(2)],
            'A name too large' => ['name', Str::random(61)],
            'No description' => ['description', null],
            'A description too short' => ['description', Str::random(2)],
            'A description too large' => ['description', Str::random(1001)],
            'No category' => ['category', null],
            'A invalid category' => ['category', 'invalid'],
             'A invalid image' => ['image', 'invalid'],
            'No price' => ['price', null],
             'A negative price' => ['price', '-20139'],
            'A price equal to zero' => ['price', '0'],
            'A price too large' => ['price', '1000000000']
        ];
    }
}
