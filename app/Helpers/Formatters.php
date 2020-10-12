<?php

namespace App\Helpers;

class Formatters {

    /**
     * Format prices
     * @param String $price
     * @return String $formattedPrice
     *
     */
    public static function priceFormatter(String $price) : String {
        $length = strlen($price);
        $formattedPrice = '$ ';
        $excess = $length%3;
        $truncated = substr($price, $excess);
        $formattedPrice .= $excess > 0 ? substr($price, 0, $excess).'.' : substr($price, 0, $excess);
        for ($i=0; $i < intval($length/3); $i++) {
            $formattedPrice .= substr($truncated, $i*3, 3).'.';
        }
        return substr($formattedPrice, 0, strlen($formattedPrice)-1);
    }

    /**
     * Color states
     * @param String $state
     * @return String $color
     *
     */
    public static function stateColor(String $state) : String {
        switch ($state) {
            case 'APPROVED': {
                return '#38C172';
            }
            case 'OK':
            case 'PENDING': {
                return '#3490DC';
            }
            case 'REJECTED': {
                return 'red';
            }
            default: {
                return 'white';
            }
        }
    }
}
