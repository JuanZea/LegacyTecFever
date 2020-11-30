<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'views'
    ];

    // Relations

    public function product() : Object
    {
        return $this->belongsTo(Product::class);
    }
}
