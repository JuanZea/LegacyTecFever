<?php

namespace App\Listeners;

use App\Events\PaymentCompleted;
use App\Product;

class AssignSale
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param PaymentCompleted $event
     * @return void
     */
    public function handle(PaymentCompleted $event)
    {
        if ($event->payment->status != 'APPROVED') {
            return;
        }
        $invoice = \GuzzleHttp\json_decode($event->payment->invoice, true);
        foreach ($invoice as $fact) {
            $product = Product::find($fact['product_id']);
            $amount = $fact['amount'];
            $stats = \GuzzleHttp\json_decode($product->stats, true);
            $stats['sales'] += $amount;
            $product->stats = \GuzzleHttp\json_encode($stats);
            $product->save();
        }
    }
}
