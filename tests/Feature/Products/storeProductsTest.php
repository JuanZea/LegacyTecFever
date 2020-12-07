<?php

namespace Tests\Feature\Products;

use App\Product;
use App\ShoppingCart;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\TestHelpers;

class storeProductsTest extends TestCase
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
     * Verify that a guest cannot create products
     *
     * @test
     */
    public function aGuestCannotStoreAProduct()
    {
        // Act
        $response = $this->post(route('products.store', $this->valid_product_request));

        // Assert
        $response->assertRedirect('login');
        $this->assertDatabaseMissing('products', $this->valid_product_request);
    }

    /**
     * Verify that an admin can create products with valid information
     *
     * @test
     */
    public function anAdminCanStoreAProductWithValidProductInputs()
    {
        // Act
        $this->actingAs($this->admin);
        $response = $this->post(route('products.store',$this->valid_product_request));

        // Assert
        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', $this->valid_product_request);
    }

    /**
     * Verify that an admin cannot create products with invalid information
     *
     * @test
     * @dataProvider invalidProductInputDataProvider
     * @param string $field
     * @param string|null $value
     */
    public function anAdminCannotStoreAProductWithInvalidProductInputs(string $field, ?string $value)
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

    /**
     * Verify that an user cannot create products
     *
     * @test
     */
    public function anUserCannotStoreAProduct()
    {
        // Arrange
        $user = factory(User::class)->create();
        factory(ShoppingCart::class)->create(['user_id' => $user->id]);

        // Act
        $this->actingAs($user);
        $response = $this->post(route('products.store', $this->valid_product_request));

        // Assert
        $response->assertStatus(403);
        $this->assertDatabaseMissing('products', $this->valid_product_request);
    }

    // PROVIDERS

    public function invalidProductInputDataProvider()
    {
        return [
            // Not input
            'No name' => ['name', null],
            'No price' => ['price', null],
            'No category' => ['category', null],
            'No description' => ['description', null],

            // Wrong input - name
            'A name too short' => ['name', Str::random(2)],
            'A name too large' => ['name', Str::random(61)],
            // Wrong input - price
            'A negative price' => ['price', '-20139'],
            'A price equal to zero' => ['price', '0'],
            'A price too large' => ['price', '1000000000'],
            // Wrong input - category
            'A invalid category' => ['category', 'invalid'],
            // Wrong input - description
            'A description too short' => ['description', Str::random(2)],
            'A description too large' => ['description', Str::random(1001)],
            // Wrong input - image
            'A invalid image' => ['image', 'invalid'],
        ];
    }
}
