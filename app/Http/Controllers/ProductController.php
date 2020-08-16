<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() : View
    {
        $products = Product::query()->orderBy('id','DESC')->paginate();
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create() : View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateProductRequest $request
     * @return View
     */
    public function store(CreateProductRequest $request) : View
    {
        $request = $request->validated();
        if(isset($request['image'])){
            $imagePath = $request['image']->store('images', 'public');
            unset($request['image']);
            $request = array_merge($request,['image' => $imagePath]);
        }
        $product = Product::create($request);
        $product->save();
        $products = Product::paginate();
        return view('products.index',compact('products'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return View
     */
    public function show(Product $product) : View
    {
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return View
     */
    public function edit(Product $product) : View
    {
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return View
     */
    public function update(UpdateProductRequest $request, Product $product) : View
    {
        $request = $request->validated();
        if(isset($request['image'])){
            if($request['image'] != './public/storage/images/ASUSVivoBook.jpg'){
                $imagePath = $request['image']->store('images', 'public');
                unset($request['image']);
                $request = array_merge($request,['image' => $imagePath]);
            }
        } else
            unset($request['image']);
        $product->update($request);

        return view('products.show', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product) : RedirectResponse
    {
        Storage::disk('public')->delete($product->image);
        $product->delete();
        return redirect()->route('products.index');
    }
}
