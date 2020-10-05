<?php

namespace App;

use Dnetix\Redirection\PlacetoPay;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'reference', 'status', 'requestId', 'message', 'amount', 'url'
    ];

    /**
     * Update the payment status
     *
     * @retrun void
    */
    public function check() : void {
        if ($this->status != 'OK' && $this->status != 'PENDING') {
            return;
        }
        $seed = date('c');

        if (function_exists('random_bytes')) {
            $nonce = bin2hex(random_bytes(16));
        } elseif (function_exists('openssl_random_pseudo_bytes')) {
            $nonce = bin2hex(openssl_random_pseudo_bytes(16));
        } else {
            $nonce = mt_rand();
        }

        $nonceBase64 = base64_encode($nonce);

        $placetoPay = new PlacetoPay([
            'login' => config('placetopay.login'),
            'seed' => $seed,
            'nonce' => $nonceBase64,
            'tranKey' => config('placetopay.secretkey'),
            'url' => config('placetopay.url'),
        ]);
        $response = $placetoPay->query($this->requestId);
        $this->status = $response->status()->status();
        $this->message = $response->status()->message();
        $this->save();
    }

    // Relations

    public function products() {
        return $this->hasMany(ImmutableProduct::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
