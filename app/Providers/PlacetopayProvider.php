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
            $seed = date('c');

            if (function_exists('random_bytes')) {
                $nonce = bin2hex(random_bytes(16));
            } elseif (function_exists('openssl_random_pseudo_bytes')) {
                $nonce = bin2hex(openssl_random_pseudo_bytes(16));
            } else {
                $nonce = mt_rand();
            }

            $nonceBase64 = base64_encode($nonce);

            return new PlacetoPay([
                'login' => config('placetopay.login'),
                'seed' => $seed,
                'nonce' => $nonceBase64,
                'tranKey' => config('placetopay.secretkey'),
                'url' => config('placetopay.url'),
            ]);
        });
    }
}
