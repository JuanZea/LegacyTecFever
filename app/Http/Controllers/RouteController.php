<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RouteController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth')->except('welcome');
    	$this->middleware('verified')->except('welcome');
    	$this->middleware('isAdmin')->only('controlPanel');
	}

    public function welcome() : Object
    {
	if (Auth::check())
	return redirect()->route('home');
    return view('welcome');
    }

    public function home() : Object
    {
    	return view('home');
    }

    public function controlPanel() : Object
    {
        return view('controlPanel');
    }
}
