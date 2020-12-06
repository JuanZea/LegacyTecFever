<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\Products\Products\ImportRequest;
use App\Imports\ProductsImport;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function import(ImportRequest $request)
    {
        $import = new ProductsImport();
        $import->import($request->file('import_file'));
        $importedProducts = $import->toArray($request->file('import_file'))[0];

        return redirect()->route('products.index')->with('message', trans('products.messages.import', ['count' => count($importedProducts)]));
    }
}
