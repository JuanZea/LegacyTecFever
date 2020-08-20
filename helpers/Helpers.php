<?php

namespace Helpers;

class Helpers {
    /**
     * Format it at a price
     *
     * @return string
     */
    public static function priceFormat(string $price) : string
    {
        $lenght = strlen($price);
        $formatPrice='';
        for ($i=-3; $i; $i-=3) {
           $formatPrice = '.'.substr($i,3);
        }
        return 'f';
    }
}
