<?php

namespace App\Helpers;

use App\Product;
use Illuminate\Database\Eloquent\Collection;

class Detectors {

    /**
     * Detect of most viewed
     * @param array $products
     * @param array|null $most_viewed_products
     * @return array|null $most_viewed_product
     */
    public static function most_viewed_products(array $products, array $most_viewed_products) : ?array
    {
//        if (count($products) == 0 && count($most_viewed_products) != 5) {
//            return null;
//        }
        if (count($most_viewed_products) == 5) {
            $winner = \GuzzleHttp\json_decode($most_viewed_products[0]['stats'], true)['views'] == \GuzzleHttp\json_decode($most_viewed_products[1]['stats'], true)['views'] ? false : true;
            array_push($most_viewed_products, $winner);
            return $most_viewed_products;
        }

        $max_views = 0;
        $max_product = $products[0];
        $max_idx = 0;

        for ($idx = 0; $idx < count($products); $idx++) {
            $views = \GuzzleHttp\json_decode($products[$idx]['stats'], true)['views'];
            if ($views > $max_views) {
                $max_views = $views;
                $max_product = $products[$idx];
                $max_idx = $idx;
            }
        }

        array_push($most_viewed_products, $max_product);
        unset($products[$max_idx]);
        $new_products = [];
        foreach ($products as $product) {
            array_push($new_products, $product);
        }

        return self::most_viewed_products($new_products, $most_viewed_products);
    }
}
