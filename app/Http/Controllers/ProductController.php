<?php

namespace App\Http\Controllers;

use App\Events\ProductViewed;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $this->middleware('is_admin')->except('show');
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
     * @param StoreRequest $request
     * @return RedirectResponse
     */
    public function store(StoreRequest $request) : RedirectResponse
    {
        $request = $request->validated();

        // Save image
        if (isset($request['image_path'])) {
            unset($request['image']);
            $request = array_merge($request,['image' => $request['image_path']]);
            unset($request['image_path']);
        } else {
            if(isset($request['image'])){
                $imagePath = $request['image']->store('images/products', 'public');
                unset($request['image']);
                $request = array_merge($request,['image' => $imagePath]);
            }
        }

        $product = Product::create($request);
//        ProductCreated::dispatch($product);
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return View
     */
    public function show(Product $product) : View
    {
        // Add a view to stats
        ProductViewed::dispatch($product);

        if (Auth::user()->is_admin) {
            return view('products.show',compact('product'));
        } else {
            if($product->is_enabled) {
                return view('products.show',compact('product'));
            } else {
                return view('errors.disabled_product');
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
     * @param UpdateRequest $request
     * @param Product $product
     * @return RedirectResponse
     */
    public function update(UpdateRequest $request, Product $product) : RedirectResponse
    {
        $request = $request->validated();

        // Delete image
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

        // To enable or disable
        if (isset($request['is_enabled'])) {
            unset($request['is_enabled']);
            $request = array_merge($request,['is_enabled' => true]);
        } else {
            $request = array_merge($request,['is_enabled' => false]);
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
