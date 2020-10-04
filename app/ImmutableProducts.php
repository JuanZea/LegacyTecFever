<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImmutableProducts extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'category', 'image', 'price', 'payment_id'
    ];

    // Relations
    public function payment() {
        $this->belongsTo(Payment::class);
    }
}
