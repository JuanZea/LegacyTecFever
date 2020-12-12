<?php

namespace App\Http\Controllers;

use App\Mail\InformationEmail;
use App\User;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function information(User $user)
    {
        $data = ['user' => $user];

        Mail::to($user->email)->send(new InformationEmail($data));

        return redirect()->back();
    }
}
