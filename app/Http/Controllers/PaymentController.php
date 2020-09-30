<?php

namespace App\Http\Controllers;

use App\ShoppingCart;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    function store(Request $request, ShoppingCart $shoppingCart, PlacetoPay $placetopay){
        // dd($shoppingCart);
        $requestPayment = [
            'buyer' => [
                'name' => 'pepita',
                'surname' => 'perez',
                'email' => 'pepita@perez.com',
                'documentType' => 'CC',
                'document' => '1000201010',
                'mobile' => '3122332233',
                'address' => [
                    'street' => 'car. 1 # 5-3',
                ]
            ],
            'payment' => [
                'reference' => '12344',
                'description' => 'pago de cualquier cosa',
                'amount' => [
                    'currency' => 'COP',
                    'total' => '100000',
                ],
            ],
            'expiration' => now()->addDay(),
            'ipAddress' => $request->ip(),
            'userAgent' => $request->header('User-Agent'),
            'returnUrl' => route('home'),
        ];
        $response = $placetopay->request($requestPayment);
        if ($response->isSuccessful()) {
           //GUARDAR EL PAGO Y LO QUE TENGA QUE HACER ANTES DE PAGAR CON P2P
            return redirect($response->processUrl());
        } else {
            $response->status()->message();
        }
    }
}
