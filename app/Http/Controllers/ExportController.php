<?php

namespace App\Http\Controllers;

use App\Export;
use App\Exports\ProductsExport;
use App\Jobs\EnableDownloadButton;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() : View
    {
        $exports = Export::all();
        $exports = $exports->sortDesc();
        return view('reports.exports', compact('exports'));
    }


    public function export(Request $request) : RedirectResponse
    {
        $products_export = new ProductsExport();
        $name = $request->name;
        $date = now()->format('d-m-Y');
        $export = Export::create(['date' => $date, 'name' => $name]);
        $products_export->store($export->get_real_name,'exports')->chain([
            new EnableDownloadButton($export)
        ]);

//        return $export->download('products.xlsx');

        return redirect()->route('products.index')->with('message', trans('products.messages.export'))->with('link', 1);
    }

    /**
     * @param Export $export
     * @return StreamedResponse
     */
    public function download(Export $export) : StreamedResponse
    {
        $path = $export->name.'-'.$export->date.'.xlsx';
        return Storage::disk('exports')->download($path);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Export $export
     * @return RedirectResponse
     */
    public function destroy(Export $export) : RedirectResponse
    {
        Storage::disk('reports')->delete($export->get_real_name);
        $export->delete();
        return redirect()->route('exports.index');
    }
}
