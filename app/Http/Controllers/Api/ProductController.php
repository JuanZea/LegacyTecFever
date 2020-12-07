<?php

namespace App\Http\Controllers\Api;

use App\Actions\Products\StoreProductAction;
use App\Actions\Products\UpdateProductAction;
use App\Events\ProductViewed;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\StoreProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProductCollection
     */
    public function index(): ProductCollection
    {
        $this->authorize('viewAny', new Product());
        return ProductCollection::make(Product::query()->paginate($perPage = request('page.size'), $columns = ['*'], $pageName = 'page[number]', $page = request('page.number'))->appends(request()->except('page.number')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @param StoreProductAction $storeProductAction
     * @return ProductResource
     * @throws AuthorizationException
     */
    public function store(StoreProductRequest $request, StoreProductAction $storeProductAction): ProductResource
    {
        $this->authorize('store', new Product());
        $product = $storeProductAction->execute($request->validated());
        return ProductResource::make($product);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        $this->authorize('show', new Product());
        ProductViewed::dispatch($product);
        return ProductResource::make($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @param UpdateProductAction $updateProductAction
     * @return ProductResource
     */
    public function update(UpdateProductRequest $request, Product $product, UpdateProductAction $updateProductAction): ProductResource
    {
        $product = $updateProductAction->execute($request->validated(), $product);
        return ProductResource::make($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $this->authorize('delete', $product);
        Storage::disk('public')->delete($product->image);
        $product->delete();

        return response()->json(null, 204);
    }
}
