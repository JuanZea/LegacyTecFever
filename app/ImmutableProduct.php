<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImmutableProduct extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'amount', 'category', 'image', 'price', 'payment_id', 'product_id'
    ];

    // Relations

    public function payment() {
        return $this->belongsTo(Payment::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
