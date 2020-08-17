<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

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
        $products = Product::orderBy('id','DESC')
        ->name($name)
        ->paginate();
        return view('products.shop',compact('products'));
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
