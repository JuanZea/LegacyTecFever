<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

/**
 * Class ProductControllerx
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
     * @return RedirectResponse
     */
    public function store(CreateProductRequest $request) : RedirectResponse
    {
        $request = $request->validated();
        if(isset($request['image'])){
            $imagePath = $request['image']->store('images/products', 'public');
            unset($request['image']);
            $request = array_merge($request,['image' => $imagePath]);
        }
        $product = (new Product)->create($request);
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Object
     */
    public function show(Product $product) : Object
    {
        if (Auth::user()->isAdmin) {
            return view('products.show',compact('product'));
        } else {
            if($product->isEnabled) {
                return view('products.show',compact('product'));
            } else {
                return redirect()->route('home');
            }
        }
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
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product) : RedirectResponse
    {
        $request = $request->validated();
        if (!isset($request['delete'])) {
            if(isset($request['image'])){
                $imagePath = $request['image']->store('images/products', 'public');
                unset($request['image']);
                $request = array_merge($request,['image' => $imagePath]);
                Storage::disk('public')->delete($product->image);
            } else {
                unset($request['image']);
            }
        } else {
            $request['image'] = null;
            Storage::disk('public')->delete($product->image);
        }
        if (isset($request['isEnabled'])) {
            unset($request['isEnabled']);
            $request = array_merge($request,['isEnabled' => true]);
        } else {
            $request = array_merge($request,['isEnabled' => false]);
        }
        $product->update($request);

        return redirect()->route('products.show', compact('product'))->with('status',__('Updated'));
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
