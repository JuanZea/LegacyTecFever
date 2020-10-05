<?php

namespace Tests\Feature\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Tests\TestHelpers;

class updateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests for update Product
     *
     * @test
     * @dataProvider validProductInputDataProvider
     * @param string $data
     */
    public function anAdminCanUpdateProductsWithValidProductInputs($data)
    {
        // Arrange
        $admin = factory(User::class)->create(['isAdmin' => true]);
        $product = factory(Product::class)->create();
        $oldData = TestHelpers::removeTimeKeys($product->toArray());
        if (!$oldData['isEnabled']) {
            unset($oldData['isEnabled']);
        }
        $validRequest = TestHelpers::VALIDREQUESTFORPRODUCT;
        if ($data != 'new') {
            if($data == 'same') {
                $validRequest = $oldData;
            } else {
                $validRequest[$data] = $oldData[$data];
            }
        }

        // Act
        $this->actingAs($admin);
        $response = $this->put(route('products.update',$product),$validRequest);

        // Assert
        $response->assertRedirect();
        // $response->assertViewIs('products.show');
        $this->assertDatabaseHas('products',$validRequest);
        if ($data != 'new') {
            if($data == 'same') {
                $this->assertDatabaseHas('products',$oldData);
            }
            else {
                $validRequest[$data] = $oldData[$data];
                $this->assertDatabaseHas('products', [
                    $data => $oldData[$data],
                ]);
            }
        } else {
            $this->assertDatabaseMissing('products',$oldData);
        }
    }

     /**
     * Tests for update Prdoucts
     *
     * @test
     * @dataProvider invalidProductInputDataProvider
     * @param string $field
     * @param string|null $value
     */
    public function anAdminCannotUpdateProductWithInvalidUserInputs(string $field, ?string $value)
    {
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

    public function validProductInputDataProvider()
    {
        return [
            'New data' => ['new'],
            'Same data' => ['same'],
            'Same name' => ['name'],
            'Same description' => ['description'],
            'Same category' => ['category'],
            'Same image' => ['image'],
            'Same price' => ['price']
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
