<?php

namespace App\Listeners;

use App\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DoSome
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->job->getName() == 'Illuminate\Queue\CallQueuedHandler@call') {
            User::create([
                'name' => 'Marte',
                'email' => 'marte@marte.com',
                'password' => 'password',
            ]);
        }
        User::create([
                'name' => 'OELOIDE',
                'email' => 'marte@marte.com',
                'password' => 'password',
            ]);
    }
}
