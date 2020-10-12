<?php

namespace App\Http\Controllers;

use App\ImmutableProduct;
use App\Payment;
use App\Product;
use App\ShoppingCart;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    function retry(Request $request) {
        $payment = Payment::find($request->payment_id);
        $shoppingCart = ShoppingCart::create([
            'user_id' => $payment->user_id,
        ]);

        foreach ($payment->products as $product) {
            $shoppingCart->carry($product->product, $product->amount);
        }
        $shoppingCart->save();

        return redirect()->route('payment',['shopping_cart_id'=> $shoppingCart->id]);
    }

    function payment(Request $request, PlacetoPay $placetopay) {
        $shoppingCart = ShoppingCart::with('user')->find($request->shopping_cart_id);
        $user = $shoppingCart->user;
        $total = $shoppingCart->totalPrice;
        $reference = time().'-'.$user->id;
        if ($shoppingCart->description == null) {
            $description = __('Purchase of technological devices');
        } else {
            $description = __($shoppingCart->description);
        }
        $requestPayment = [
            'buyer' => [
                'name' => $user->name,
                'surname' => $user->surname,
                'email' => $user->email,
                'document' => $user->document,
                'documentType' => $user->documentType,
                'mobile' => $user->mobile
            ],
            'payment' => [
                'reference' => $reference,
                'description' => $description,
                'amount' => [
                    'currency' => 'COP',
                    'total' => $total
                ],
            ],
            'expiration' => now()->addSecond(60),
            'ipAddress' => $request->ip(),
            'userAgent' => $request->header('User-Agent'),
            'returnUrl' => route('paymentResponse', compact('reference')),
        ];

        $response = $placetopay->request($requestPayment);
        if ($response->isSuccessful()) {
            $requestId = $response->requestId;
            $status = $response->status()->status();
            $message = $response->status()->message();
            $url = $response->processUrl();
            $payment = Payment::create(['user_id' => $user->id, 'reference'=>$reference, 'status'=>$status, 'requestId'=>$requestId, 'message'=>$message, 'amount'=>$total, 'url'=>$url]);

            $shoppingCart->immortalize($payment->id);
            $shoppingCart->delete();

            return redirect($url);
        } else {
            return $response->status()->message();
            $response->status()->message();
            dd('aqui');
        }
    }

    public function paymentResponse(Request $request) {
        $payment = Payment::where('reference', $request->reference)->first();
        $payment->check();
        return view('paymentResponse', compact('payment'));
    }
}
