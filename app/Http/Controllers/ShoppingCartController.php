<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveShoppingCartRequest;
use App\Product;
use App\ShoppingCart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ShoppingCartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('is_enabled');
        $this->middleware('verified');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SaveShoppingCartRequest $request
     * @return RedirectResponse
     */
    public function store(SaveShoppingCartRequest $request) : RedirectResponse
    {
        $request = $request->validated();

        $product = Product::find($request['product_id']);
        $amount = $request['amount'];

        // Save to cart or create a new one
        $shoppingCart = Auth::user()->shoppingCart;
        if (!$shoppingCart) {
            $shoppingCart = new ShoppingCart([
                'user_id' => Auth::id(),
            ]);
            $shoppingCart->save();
        }

        $shoppingCart->carry($product, $amount);

        $shoppingCart->save();


        return back()->with('status',__('Added to cart'));
    }

    /**
     * Display the specified resource.
     *
     * @param  ShoppingCart $shoppingCart | ->nullable();
     * @return View
     */
    public function show(ShoppingCart $shoppingCart) : view
    {
        return view('shoppingCarts.show',compact('shoppingCart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ShoppingCart $shoppingCart
     * @return View
     */
    public function edit(ShoppingCart $shoppingCart, Request $request) : view
    {
//        dd($shoppingCart->products->where('id',$request->product_id));
        return view('shoppingCarts.edit', ['shoppingCart'=>$shoppingCart, 'product_id'=>$request->product_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, ShoppingCart $shoppingCart) : RedirectResponse
    {
        if ($request->amount < 0) {
            return back()->with('error',__('Negative numbers are invalid'));
        }
        $product = Product::find($request->product_id);
        $amount = 0;
        if(isset($request->amount) || $request->amount > 0) {
            $amount = $request->amount;
        }
        $shoppingCart->change($product, $amount);
        $shoppingCart->save();
        return redirect()->route('shoppingCarts.show', $shoppingCart);
    }

    /**
     * Remove all products from the shopping cart
     *
     * @param  ShoppingCart $shoppingCart
     * @return RedirectResponse
     */
    public function clean(ShoppingCart $shoppingCart) : RedirectResponse
    {
        if (!isset($shoppingCart)) {
            return back();
        }
        $shoppingCart->clean();
        return redirect()->route('shoppingCarts.show', $shoppingCart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ShoppingCart $shoppingCart
     * @return RedirectResponse
     */
    public function destroy(ShoppingCart $shoppingCart) : RedirectResponse
    {
        $shoppingCart->delete();
        return redirect()->route('home');
    }
}
