<?php

namespace App\Http\Controllers;

use App\Export;
use App\Helpers\Detectors;
use App\Jobs\GenerateReport;
use App\Product;
use App\Report;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;
use function App\View\Components\render;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_admin');
    }

    /**
     *
     */
    public function generate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:10'
        ]);

        $date = now()->format('d-m-Y');
        $name = $request->name;

        $this->dispatch(new GenerateReport($date, $name));

        return redirect()->route('reports.summary')->with('message', trans('reports.message.generate'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function summary() : View
    {
        $reports = Report::all()->sortByDesc->toArray();
        return view('reports.summary', compact('reports'));
    }

    /**
     * @param Export $export
     * @return StreamedResponse
     */
    public function download(Report $report) : StreamedResponse
    {
        return Storage::disk('reports')->download($report->get_path);
    }

    /**
     * @return View
     */
    public function specifics() : View
    {
        $products = Product::query()->orderBy('id','DESC')->paginate();
        return view('reports.specifics',compact('products'));
    }

    /**
     *
    */
    public function destroy(Report $report)
    {
        Storage::disk('reports')->delete($report->get_path);
        $report->delete();
        return redirect()->route('reports.summary');
    }
}
