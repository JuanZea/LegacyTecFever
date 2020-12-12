<?php

namespace App\Listeners;

use App\ShoppingCart;
use Illuminate\Auth\Events\Registered;

class AssignShoppingCart
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        ShoppingCart::create([
            'user_id' => $event->user->getAuthIdentifier(),
        ]);
    }
}
