<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        return response()->json([
            'data' => User::all()
        ]);
    }

    public function show(User $user) {
        return response()->json([
            'data' => $user
        ]);
    }
}
