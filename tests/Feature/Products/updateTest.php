<?php

namespace Tests\Feature\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class updateTest extends TestCase
{
    use RefreshDatabase;
    protected $request = [
        'name' => 'Acer Aspire 5 Slim Laptop',
        'description' => '15.6 inches Full HD IPS Display, AMD Ryzen 3 3200U, Vega 3 Graphics, 4GB DDR4, 128GB SSD, Backlit Keyboard, Windows 10 in S Mode, A515-43-R19L,Silver',
        'category' => 'computer',
        // 'image' => 'https://lorempixel.com/1200/400/?63626',
        'price' => '2900000'
    ];

    /**
     * Tests for update Product
     *
     * @test
     * @dataProvider ValidProductInputDataProvider
     * @param string $data
     */
    public function anAdminCanUpdateProductsWithValidProductInputs($data)
    {
        $this->withoutExceptionHandling();
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        $product = factory(Product::class)->create();
        $oldData = removeTimeKeys($product->toArray());
        $validRequest = $this->request;
        if ($data != 'new')
            if($data == 'same')
                $validRequest = $oldData;
            else
                $validRequest[$data] = $oldData[$data];

        // Act
        $this->actingAs($admin);
        $response = $this->put(route('products.update',$product),$validRequest);

        // Assert
        $response->assertOk();
        $response->assertViewIs('products.show',$product->id);
        $this->assertDatabaseHas('products',$validRequest);
        if ($data != 'new')
            if($data == 'same')
                $this->assertDatabaseHas('products',$oldData);
            else{
                $validRequest[$data] = $oldData[$data];
                // dd($validRequest);
                $this->assertDatabaseHas('products', [
                    $data => $oldData[$data],
                ]);
            }
        else
        $this->assertDatabaseMissing('products',$oldData);
    }

     /**
     * Tests for update Prdoucts
     *
     * @test
     * @dataProvider InvalidProductInputDataProvider
     * @param string $field
     * @param string|null $value
     */
    public function anAdminCannotUpdateProductWithInvalidUserInputs(string $field, ?string $value)
    {
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

    public function ValidProductInputDataProvider()
    {
        return [
            'New data' => ['new'],
            'Same data' => ['same'],
            'Same name' => ['name'],
            'same description' => ['description'],
            'Same category' => ['category'],
            'Same image' => ['image'],
            'Same price' => ['price']
        ];
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
