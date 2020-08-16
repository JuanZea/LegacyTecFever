<?php

namespace Tests\Feature\Products;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\TestHelpers;

class storeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests for store Products
     *
     * @test
     */
    public function anAdminCanStoreAProductWithValidProductInputs()
    {
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);

        // Act
        $this->actingAs($admin);
        $response = $this->post(route('products.store',TestHelpers::VALIDREQUESTFORPRODUCT));

        // Assert
        $response->assertOk();
        $response->assertViewIs('products.index');
        $this->assertDatabaseHas('products', TestHelpers::VALIDREQUESTFORPRODUCT);
    }

    /**
     * Tests for store Products
     *
     * @test
     * @dataProvider invalidProductInputDataProvider
     * @param string $field
     * @param string|null $value
     */
    public function anAdminCannotStoreAProductWithInvalidProductInputs(string $field, ?string $value)
    {
        $this->withExceptionHandling();
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        $invalidRequest = TestHelpers::VALIDREQUESTFORPRODUCT;
        $invalidRequest[$field] = $value;

        // Act
        $this->actingAs($admin);
        $response = $this->post(route('products.store',$invalidRequest));

        // Assert
        $response->assertRedirect();
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('products',$invalidRequest);
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
