<?php

namespace App\Providers;

use Dnetix\Redirection\PlacetoPay;
use Illuminate\Support\ServiceProvider;

class PlacetopayProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(PlacetoPay::class, function () {
            return new PlacetoPay([
                'login' => config('placetopay.login'),
                'tranKey' => config('placetopay.trankey'),
                'url' => config('placetopay.url')
            ]);
        });
    }
}
