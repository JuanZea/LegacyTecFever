<?php

namespace App\Http\Controllers;

use App\Mail\TestEmail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class RouteController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except('welcome');
    	$this->middleware('verified')->except('welcome');
    	$this->middleware('is_admin')->only('control_panel');
    	$this->middleware('is_enabled')->except('welcome','disabled');
	}

	public function send_mail()
    {
        $data = ['message' => 'This is a test!'];

        Mail::to('juandavi1111@gmail.com')->send(new TestEmail($data));

        return redirect()->route('home');
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
    public function control_panel() : View
    {
        return view('control_panel');
    }

    /**
     * Display a shop view.
     *
     * @param Request $request
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
            if ($product->is_enabled) {
                $empty=false;
            }
        }
        return view('shop',['products'=>$products,'name'=>$name,'empty'=>$empty]);
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
            return view('shoppingCarts.empty');
        } else {
            if ($shoppingCart->amount == 0) {
                $shoppingCart->delete();
                return view('shoppingCarts.empty');
            }
        }

        return redirect()->route('shopping-cart.show', $shoppingCart);

    }

    /**
     * Display a account view.
     *
     * @param Request $request
     * @return View
     */
    public function account(): View
    {
        $user = Auth::user();
        $payments = $user->payments;
        foreach ($payments as $payment) {
            $payment->check();
        }
        return view('account.profile', compact('user'));
    }

    /**
     * Display a account view.
     *
     * @param Request $request
     * @return View
     */
    public function shopping_history(): View
    {
        $user = Auth::user();
        $payments = $user->payments;
        foreach ($payments as $payment) {
            $payment->check();
        }
        return view('account.shopping_history', compact('user'));
    }

    /**
     * Display a disabled view.
     *
     * @return Object
     */
    public function disabled() : Object
    {
        if (Auth::user()->is_enabled) {
            return redirect()->route('home');
        }
        return view('disabled');
    }
}
