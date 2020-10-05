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
        $lenght = strlen($price);
        $formattedPrice = '$ ';
        switch ($lenght) {
            case $lenght > 9: {
                $formattedPrice .= substr($price,0,-9).'.'.substr($price,-9,-6).'.'.substr($price,-6,-3).'.'.substr($price, -3);
                break;
            }
            case $lenght > 6: {
                $formattedPrice .= substr($price,0,-6).'\''.substr($price,-6,-3).'.'.substr($price, -3);
                break;
            }
            case $lenght > 3: {
                $formattedPrice .= substr($price,0,-3).'.'.substr($price, -3);
                break;
            }
            default: {
                $formattedPrice .= $price;
                break;
            }
        }

        return $formattedPrice;
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
