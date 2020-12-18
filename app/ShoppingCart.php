<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ShoppingCart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','amount', 'totalPrice'
    ];

    // Functions

    /**
     * Remove all products from the shopping cart
     *
     */
    public function clean() {
        $this->products()->detach();
        $this->amount = 0;
        $this->totalPrice = 0;
        $this->save();
    }

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
     * @return string
     */
    public function invoice() : String {
        $products = $this->products;

        $invoice = [];

        foreach ($products as $product) {
            $invoice = array_merge($invoice,[
                [
                'name' => $product->name,
                'description' => $product->description,
                'amount' => $product->pivot->amount,
                'category' => $product->category,
                'price' => $product->price,
                'product_id' => $product->id
                ]
            ]);
        }

        $jsonInvoice = \GuzzleHttp\json_encode($invoice);
        return  $jsonInvoice;
    }

    // Relations

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot('amount');
    }
}
