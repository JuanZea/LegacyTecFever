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

    /**
     * Generates immutable products from the originals for registration in the payment
     * @param int $payment_id
    */
    public function immortalize(int $payment_id) {
        $products = $this->products;
        foreach ($products as $product) {
            ImmutableProducts::create([
                'name' => $product->name,
                'description' => $product->description,
                'category' => $product->category,
                'image' => substr_replace($product->image, 'immutableProducts', 7, 8),
                'price' => $product->price,
                'payment_id' => $payment_id
            ]);
        }
    }

//    /**
//     * Mount products to cart
//     * @param Product $product
//     * @param int $amount
//     * @return void
//     */
//    public function updateDescription() : void {
//        $products = $this->products->where('category','computer');
//        if ($products != null) {
//            if (count($products) == 1) {
//                $this->description = 'Purchase of computer';
//            } else {
//                $this->description = 'Purchase of computers';
//            }
//        }
//
//        dd(count($products), $this);
//    }

    // Relations

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot('amount');
    }
}
