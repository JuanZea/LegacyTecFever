<?php

namespace App\Http\Controllers;

use App\Events\PaymentCompleted;
use App\Payment;
use App\Product;
use App\ShoppingCart;
use App\User;
use Dnetix\Redirection\PlacetoPay;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
    	$this->middleware('verified');
    	$this->middleware('is_enabled');
	}

    function retry(Request $request) {
        if (!isset($request->payment_id)) {
            return back();
        }
        $payment = Payment::find($request->payment_id);
        $user = User::find($payment->user_id);
        $shoppingCart = $user->shoppingCart;

        foreach (\GuzzleHttp\json_decode($payment->invoice) as $product) {
            $shoppingCart->carry(Product::find($product->product_id), $product->amount);
        }
        $shoppingCart->save();

        $request = new Request(['shopping_cart_id' => $shoppingCart->id]);
        return $this->payment($request, resolve(PlacetoPay::class));
    }

    function payment(Request $request, PlacetoPay $placetopay) {
        if (!isset($request->shopping_cart_id)) {
            return back();
        }
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
            'expiration' => now()->addMinutes(10),
            'ipAddress' => $request->ip(),
            'userAgent' => $request->header('User-Agent'),
            'returnUrl' => route('payment.response', compact('reference')),
        ];

        $response = $placetopay->request($requestPayment);
        if ($response->isSuccessful()) {
            $requestId = $response->requestId;
            $status = $response->status()->status();
            $message = $response->status()->message();
            $url = $response->processUrl();
            $invoice = $shoppingCart->invoice();
            Payment::create([
                'user_id' => $user->id,
                'reference'=> $reference,
                'status'=> $status,
                'requestId'=> $requestId,
                'message'=> $message,
                'invoice'=> $invoice,
                'amount'=> $total,
                'url'=> $url
            ]);

            $shoppingCart->clean();

            return redirect($url);
        } else {
            return $response->status()->message();
        }
    }

    /**
     * Display a payment response view.
     *
     * @param Request $request
     * @return View
     */
    public function response(Request $request) : View {
        $payment = Payment::where('reference', $request->reference)->first();
        $payment->check();
        event(new PaymentCompleted($payment));
        return view('account.payment.response', compact('payment'));
    }

    /**
     * Display a payment history view.
     *
     * @param Request $request
     * @return View
     */
    public function history(Request $request) : View
    {
        $payment = Payment::find($request->payment_id);
        return view('account.payment.history', compact('payment'));
    }
}
