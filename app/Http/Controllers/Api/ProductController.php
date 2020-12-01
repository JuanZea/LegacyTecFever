<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return ProductCollection
     */
    public function index()
    {
        return ProductCollection::make(Product::query()->paginate($perPage = request('page.size'), $columns = ['*'], $pageName = 'page[number]', $page = request('page.number'))->appends(request()->except('page.number')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return ProductResource
     */
    public function store(StoreRequest $request)
    {
        $request = $request->validated();
        if(isset($request['image'])){
            $imagePath = $request['image']->store('images/products', 'public');
            unset($request['image']);
            $request = array_merge($request,['image' => $imagePath]);
        }
        $product = (new Product)->create($request);
        $product->save();
        return ProductResource::make($product);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return ProductResource::make($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(null, 204);
    }
}
