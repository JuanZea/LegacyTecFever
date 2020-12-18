<?php

namespace Tests\Feature\Products;

use App\Product;
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
    private $product;

    public function setUp(): void
    {
        parent::setUp();
        TestHelpers::activeRoles();
        $this->valid_product_request = factory(Product::class)->raw();
        $this->admin = factory(User::class)->create(['is_enabled' => true])->assignRole('admin');
        $this->product = factory(Product::class)->create();
    }

    /**
     * @test
     */
    public function anGuestCannotUpdateProducts()
    {
        // Act
        $response = $this->put(route('products.update', $this->product), $this->valid_product_request);

        // Asserts
        $response->assertRedirect('login');
        $this->assertDatabaseMissing('products', $this->valid_product_request);
    }

    /**
     * @test
     */
    public function anUserCannotUpdateProducts()
    {
        // Arrange
        $user = factory(User::class)->create(['is_enabled' => true])->assignRole('user');

        // Act
        $this->actingAs($user);
        $response = $this->put(route('products.update', $this->product), $this->valid_product_request);

        // Asserts
        $response->assertStatus(403); // Forbidden
        $this->assertDatabaseMissing('products', $this->valid_product_request);
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
        // Arrange
        $oldData = TestHelpers::removeTimeKeys($this->product->toArray());
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
        $response = $this->put(route('products.update', $this->product), $validRequest);

        // Asserts
        $response->assertRedirect();
        $this->assertDatabaseHas('products', $validRequest);
        // Asserts - New Data
        if ($data == 'new') {
            $this->assertDatabaseMissing('products', $oldData);
        }
    }

     /**
     * @test
     * @dataProvider invalidProductInputDataProvider
     * @param string $field
     * @param string|null $value
     */
    public function anAdminCannotUpdateProductWithInvalidProductInputs(string $field, ?string $value)
    {
        // Arrange
        $invalidRequest = $this->valid_product_request;
        $invalidRequest[$field] = $value;

        // Act
        $this->actingAs($this->admin);
        $response = $this->put(route('products.update', $this->product), $invalidRequest);

        // Assert
        $response->assertRedirect();
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('products', $invalidRequest);
    }

    // PROVIDERS

    public function validProductInputDataProvider(): array
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

    public function invalidProductInputDataProvider(): array
    {
        return [
            'No name' => ['name', null],
            'A name too short' => ['name', Str::random(2)],
            'A name too large' => ['name', Str::random(61)],
            'No description' => ['description', null],
            'A description too short' => ['description', Str::random(2)],
            'A description too large' => ['description', Str::random(1001)],
            'A invalid category' => ['category', 'invalid'],
             'A invalid image' => ['image', 'invalid'],
            'No price' => ['price', null],
             'A negative price' => ['price', '-20139'],
            'A price equal to zero' => ['price', '0'],
            'A price too large' => ['price', '1000000000']
        ];
    }
}
