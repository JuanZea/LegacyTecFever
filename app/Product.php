<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed image
 */
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

    /**
     * Returns the url of the product image
     * @return String
     */
    public function getGetImageAttribute() : String
    {
        if ($this->image) {
            return url("storage/$this->image");
        }
        return url("images/main/IND.png");
    }

    // Query Scopes

    /**
     * Filter shop products by name
     * @param Builder $query
     * @param String $name
     * @return Builder
     */
    public function scopeName(Builder $query, String $name) : Builder
    {
        if ($name) {
            return $query->where('name','LIKE',"%$name%");
        }
        return $query;
    }
}
