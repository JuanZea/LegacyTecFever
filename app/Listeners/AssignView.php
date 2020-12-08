<?php

namespace App\Listeners;

use App\Events\ProductViewed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AssignView
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
     * @param  ProductViewed  $event
     * @return void
     */
    public function handle(ProductViewed $event)
    {
        $stats = \GuzzleHttp\json_decode($event->product->stats, true);
        $stats['views'] = $stats['views'] + 1;
        $event->product->stats = \GuzzleHttp\json_encode($stats);
        $event->product->save();
    }
}
