<?php

namespace App\Http\Controllers;

use App\Export;
use App\Helpers\Detectors;
use App\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
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
    public function summary() : View
    {
        $products = Product::all();
        $most_viewed_product = Detectors::most_viewed_product($products);
        return view('reports.summary', compact('most_viewed_product'));
    }

    /**
     * @param Export $export
     * @return StreamedResponse
     */
    public function download(Export $export) : StreamedResponse
    {
        $path = $export->name.'-'.$export->date.'.xlsx';
        return Storage::disk('reports')->download($path);
    }

    /**
     * @return View
     */
    public function specifics() : View
    {
        $products = Product::query()->orderBy('id','DESC')->paginate();
        return view('reports.specifics',compact('products'));
    }

}
