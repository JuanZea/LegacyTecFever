<?php

namespace App\Http\Controllers;

use App\Actions\Products\StoreProductAction;
use App\Actions\Products\UpdateProductAction;
use App\Events\ProductViewed;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index() : View
    {
        $this->authorize('viewAny', new Product());
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
        $this->authorize('create', new Product());
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @param StoreProductAction $storeProductAction
     * @return RedirectResponse
     */
    public function store(StoreProductRequest $request, StoreProductAction $storeProductAction) : RedirectResponse
    {
        $storeProductAction->execute($request->validated());
        return redirect()->route('products.index')->with('message', trans('products.messages.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return View
     */
    public function show(Product $product) : View
    {
        $this->authorize('view', new Product());
        ProductViewed::dispatch($product);

        if (Auth::user()->hasRole('admin') || $product->is_enabled) {
            return view('products.show',compact('product'));
        } else {
            return view('errors.disabled_product');
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
        $this->authorize('edit', new Product());
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @param UpdateProductAction $updateProductAction
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product, UpdateProductAction $updateProductAction) : RedirectResponse
    {
        $updateProductAction->execute($request->validated(), $product);
        return redirect()->route('products.show', compact('product'))->with('message', trans('products.messages.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */
    public function destroy(Product $product) : RedirectResponse
    {
        $this->authorize('delete', $product);
        Storage::disk('public')->delete($product->image);
        $product->delete();
        return redirect()->route('products.index');
    }
}
