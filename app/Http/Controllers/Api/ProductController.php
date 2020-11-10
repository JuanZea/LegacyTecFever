<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return ProductCollection::make(Product::query()->paginate($perPage = request('page.size'), $columns = ['*'], $pageName = 'page[number]', $page = request('page.number'))->appends(request()->except('page.number')));
    }

    public function show(Product $product) {
        return ProductResource::make($product);
    }
}
