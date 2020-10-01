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
        // It already exists?
        $this->amount += $amount;
        $this->totalPrice += ($amount*$product->price);

        if($this->products->where('id',$product->id)->first() != null) {
            $this->products()->detach($product->id);
            $amount = $this->products->where('id',$product->id)->first()->pivot->amount + $amount;
        }
        $this->products()->attach($product->id, ['amount'=>$amount]);

    }

    /**
     * Edit products in the cart
     * @param Product $product
     * @param int $amount
     * @return void
     */
    public function change(Product $product, int $amount) : void {
        // Drop
        $this->amount -= $this->products->where('id',$product->id)->first()->pivot->amount;
        $this->totalPrice -= (($this->products->where('id',$product->id)->first()->pivot->amount)*$product->price);
        $this->products()->detach($product->id);
        $this->save();

        // Delete or not
        if ($amount != 0) {
            $this->amount += $amount;
            $this->totalPrice += ($amount*$product->price);
            $this->products()->attach($product->id, ['amount'=>$amount]);
        }
    }

    // Relations

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('amount');
    }
}
