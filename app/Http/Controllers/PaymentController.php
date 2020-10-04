<?php

namespace App\Http\Controllers;

use App\ImmutableProducts;
use App\Payment;
use App\ShoppingCart;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    function payment(Request $request, PlacetoPay $placetopay) {
        $shoppingCart = ShoppingCart::find($request->shopping_cart_id);
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
            'expiration' => now()->addMinutes(10),
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
            $payment = Payment::create(['reference'=>$reference, 'status'=>$status, 'requestId'=>$requestId, 'message'=>$message, 'amount'=>$total, 'url'=>$url]);

            $shoppingCart->immortalize($payment->id);
            $shoppingCart->delete();

            return redirect($url);
        } else {
            $response->status()->message();
        }
    }

    public function paymentResponse(Request $request) {
        $payment = Payment::where('reference', $request->reference)->first();
        $payment->check();
        return view('paymentResponse', compact('payment'));
    }
}
