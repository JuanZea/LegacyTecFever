<?php

namespace Tests\Feature\Excel;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ImportTest extends TestCase
{
    use RefreshDatabase;

    public function test()
    {
        $this->assertTrue(true);
    }

    /**
    * @test
    */
    public function adminCanImportProducts()
    {
        // Arrange
        $path = base_path('tests/stubs/valid_file.xlsx');
        $importFile = new UploadedFile($path, 'valid_file.xlsx', null, null, true);

        // Act
        $response = $this->post(route('import'), ['import_file' => $importFile]);

        // Asserts
        $response->assertSessionHas('message');
        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseHas('products', ['name' => 'El primero', 'stock' => 29]);
    }
}
