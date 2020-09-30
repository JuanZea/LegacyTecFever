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
        'user_id','itemsCount', 'totalPrice', 'redeemable'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
