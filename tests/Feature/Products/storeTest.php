<?php

namespace Tests\Feature\Products;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class storeTest extends TestCase
{
    use RefreshDatabase;
    protected $request = [
        'name' => 'Acer Aspire 5 Slim Laptop',
        'description' => '15.6 inches Full HD IPS Display, AMD Ryzen 3 3200U, Vega 3 Graphics, 4GB DDR4, 128GB SSD, Backlit Keyboard, Windows 10 in S Mode, A515-43-R19L,Silver',
        'category' => 'computer',
        'image' => 'https://lorempixel.com/1200/400/?63626',
        'price' => '2900000'
    ];

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
        $response = $this->post(route('products.store',$this->request));

        // Assert
        $response->assertOk();
        $response->assertViewIs('products.index');
        $this->assertDatabaseHas('products', $this->request);
    }

    /**
     * Tests for store Products
     *
     * @test
     * @dataProvider InvalidProductInputDataProvider
     * @param string $field
     * @param string|null $value
     */
    public function anAdminCannotStoreAProductWithInvalidProductInputs(string $field, ?string $value)
    {
        $this->withExceptionHandling();
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        $invalidRequest = $this->request;
        $invalidRequest[$field] = $value;

        // Act
        $this->actingAs($admin);
        // dd($invalidRequest);
        $response = $this->post(route('products.store',$invalidRequest));

        // Assert
        $response->assertRedirect();
        $response->assertSessionHasErrors();
        $this->assertDatabaseMissing('products',$invalidRequest);
    }

    /**
     * Tests for store Product
     *
     * @test
     */
    public function anUserCannotStoreProducts()
    {
        // Arrange
        $user = factory(User::class)->create();

        // Act
        $this->actingAs($user);
        $response = $this->post(route('products.store',$this->request));

        // Assert
        $response->assertRedirect();
        $this->assertDatabaseMissing('products', $this->request);
    }

    /**
     * Tests for store Product
     *
     * @test
     */
    public function anGuestCannotStoreProducts()
    {
        // Act
        $response = $this->post(route('products.store',$this->request));

        // Assert
        $response->assertRedirect('login');
    }

    public function InvalidProductInputDataProvider()
    {
        return [
            'No name' => ['name', null],
            'A name too short' => ['name', Str::random(2)],
            'A name too large' => ['name', Str::random(41)],
            'No description' => ['description', null],
            'A description too short' => ['description', Str::random(2)],
            'A description too large' => ['description', Str::random(1001)],
            'No category' => ['category', null],
            'A invalid category' => ['category', 'invalid'],
            'No image' => ['image', null],
            // 'A invalid image' => ['image', 'invalid'],
            'No price' => ['price', null],
            // 'A negative price' => ['price', -20139],
            'A price equal to zero' => ['price', '0'],
            'A price too large' => ['price', '1000000000']
        ];
    }
}
