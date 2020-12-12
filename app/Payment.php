<?php

namespace App;

use Dnetix\Redirection\PlacetoPay;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'reference', 'status', 'requestId', 'message', 'invoice', 'amount', 'url'
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

        $placetoPay = resolve(PlacetoPay::class);

        $response = $placetoPay->query($this->requestId);
        $this->status = $response->status()->status();
        $this->message = $response->status()->message();
        $this->save();
    }

    // Relations

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
