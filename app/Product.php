<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'category', 'image', 'price',
    ];

    public function getGetImageAttribute()
    {
        return url("storage/$this->image");
        // return Storage::disk('public')->url($this->image);
    }
}
