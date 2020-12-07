<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\ImportProductRequest;
use App\Imports\ProductsImport;
use Illuminate\Http\RedirectResponse;

class ImportController extends Controller
{
    public function import(ImportProductRequest $request): RedirectResponse
    {
        $import = new ProductsImport();
        $import->import($request->file('import_file'));
        $importedProducts = $import->toArray($request->file('import_file'))[0];

        return redirect()->route('products.index')->with('message', trans('products.messages.import', ['count' => count($importedProducts)]));
    }
}
