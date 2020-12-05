<?php

namespace Tests\Feature;

use App\Imports\ProductsImport;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class ImportTest extends TestCase
{
    use RefreshDatabase;

    public function test()
    {
        $this->assertTrue(true);
    }

    /**
    *
    */
    public function admin_can_import_products()
    {
        $this->withExceptionHandling();
        // Arrange
        Excel::fake();

        $admin = factory(User::class)->create(['is_admin' => true]);
        $file = Storage::disk('test_files')->get('valid_file.xlsx');

        // Act
        $this->actingAs($admin);
        $response = $this->post(route('import', ['import_file' => $file]));

        // Asserts
        $response->assertRedirect();
//        $response->assertSessionHas('message');

//        Excel::assertImported('valid_file.xlsx', function(ProductsImport $import) {
//            return true;
//        });

//        Excel::assertImported('valid_file.xlsx', 'reports');

//        Excel::assertImported('valid_file.xlsx', 'reports', function(ProductsImport $import) {
//            return true;
//        });

    }
}
