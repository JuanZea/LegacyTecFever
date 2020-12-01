<?php

namespace App\Providers;

use App\Events\ProductCreated;
use App\Events\ProductViewed;
use App\Listeners\AddAView;
use App\Listeners\AssignShoppingCart;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            AssignShoppingCart::class,
        ],
        ProductViewed::class => [
            AddAView::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
