<?php

namespace App\Helpers;


class Detectors {

    /**
     * Detect of most viewed
     * @param array $products
     * @param array|null $max_stats
     * @param $stats
     * @return array|null $most_viewed_product
     */
    public static function maxProductsStats(array $products, array $max_stats, $stats) : ?array
    {
        if (count($products) == 0 && count($max_stats) != 5) {
            return null;
        }
        if (count($max_stats) == 5) {
            $winner = \GuzzleHttp\json_decode($max_stats[0]['stats'], true)[$stats] == \GuzzleHttp\json_decode($max_stats[1]['stats'], true)['views'] ? false : true;
            array_push($max_stats, $winner);
            return $max_stats;
        }

        $max_views = 0;
        $max_product = $products[0];
        $max_idx = 0;

        for ($idx = 0; $idx < count($products); $idx++) {
            $views = \GuzzleHttp\json_decode($products[$idx]['stats'], true)[$stats];
            if ($views > $max_views) {
                $max_views = $views;
                $max_product = $products[$idx];
                $max_idx = $idx;
            }
        }

        array_push($max_stats, $max_product);
        unset($products[$max_idx]);
        $new_products = [];
        foreach ($products as $product) {
            array_push($new_products, $product);
        }

        return self::maxProductsStats($new_products, $max_stats, $stats);
    }

    /**
     * @param array $products
     * @return array
     */
    public static function mostStock(array $products): array
    {
        $most_stock = [];
        for ($idx = 0; $idx < 5; $idx++) {
            array_push($most_stock, $products[$idx]);
        }
        if ($most_stock[0] != $most_stock[1]) {
            array_push($most_stock, true);
        } else {
            array_push($most_stock, false);
        }

        return $most_stock;
    }
}
