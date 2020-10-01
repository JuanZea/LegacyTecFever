<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','amount', 'totalPrice', 'redeemable'
    ];

    // Functions

    /**
     * Mount products to cart
     * @param Product $product
     * @param int $amount
     * @return void
     */
    public function carry(Product $product, int $amount) : void {
        $this->amount += $amount;
        $this->totalPrice += ($amount*$product->price);
        $this->products()->attach($product->id, ['amount'=>$amount]);
    }

    // Relations

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('amount');
    }
}
