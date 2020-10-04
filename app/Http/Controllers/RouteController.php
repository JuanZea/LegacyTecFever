<?php

namespace App\Http\Controllers;

use App\Product;
use App\ShoppingCart;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use PhpParser\Node\Expr\Cast\Object_;

class RouteController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except('welcome');
    	$this->middleware('verified')->except('welcome');
    	$this->middleware('isAdmin')->only('controlPanel');
    	$this->middleware('isEnabled')->except('welcome','disabled');
	}

    /**
     * Display a welcome view.
     *
     * @return Object
     */
    public function welcome() : Object
    {
        if (Auth::check()) {
          return redirect()->route('home');
        }
        return view('welcome');
    }

    /**
     * Display a home view.
     *
     * @return View
     */
    public function home() : View
    {
    	return view('home');
    }

    /**
     * Display a control panel view.
     *
     * @return View
     */
    public function controlPanel() : View
    {
        return view('controlPanel');
    }

    /**
     * Display a shop view.
     *
     * @return View
     */
    public function shop(Request $request) : View
    {
        $name = $request->get('name');
        $products = (new Product)->orderBy('id','DESC')
        ->name($name)
        ->paginate();
        $empty = true;
        foreach ($products as $product) {
            if ($product->isEnabled) {
                $empty=false;
            }
        }
        return view('products.shop',['products'=>$products,'name'=>$name,'empty'=>$empty]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Object
     */
    public function shoppingCartRouter() : Object
    {
        $shoppingCart = Auth::user()->shoppingCart;

        // Initialize shoppingCart
        if (!$shoppingCart) {
            return view('shopping-carts.empty');
        } else {
            if ($shoppingCart->amount == 0) {
                $shoppingCart->delete();
                return view('shopping-carts.empty');
            }
        }

        return redirect()->route('shopping-cart.show', $shoppingCart);

    }

    /**
     * Display a account view.
     *
     * @param int $section
     * @return View
     */
    public function account(int $section)
    {
        $user = Auth::user();
        switch ($section) {
            case 0: {
                return view('account.profile', ['section'=>$section, 'user' =>$user]);
            }
            case 1: {
                return view('account.shoppingHistory', ['section'=>$section, 'user' =>$user]);
            }
            case 2: {
                return view('account.configuration', ['section'=>$section, 'user' =>$user]);
            }
            default : {
                abort(404);
            }
        }
    }

    /**
     * Display a disabled view.
     *
     * @return Object
     */
    public function disabled() : Object
    {
        if (Auth::user()->isEnabled) {
            return redirect()->route('home');
        }
        return view('disabled');
    }
}
