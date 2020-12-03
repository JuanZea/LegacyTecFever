<?php

namespace App\Helpers;

use App\Product;
use Illuminate\Database\Eloquent\Collection;

class Detectors {

    /**
     * Detect of most viewed
     * @param array $products
     * @return Product|null $most_viewed_product
     */
    public static function most_viewed_product(Collection $products) : ?Product
    {
        if (count($products) == 0) {
            return null;
        }

        $max_views = 0;
        $max_product = $products[0];

        foreach ($products as $product) {
            $views = \GuzzleHttp\json_decode($product->stats, true)['views'];
            if ($views > $max_views) {
                $max_views = $views;
                $max_product = $product;
            }
        }

        return $max_product;
    }
}
