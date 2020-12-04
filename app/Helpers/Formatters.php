<?php

namespace App\Helpers;

use phpDocumentor\Reflection\Types\Nullable;
use function _HumbugBoxbde535255540\RingCentral\Psr7\str;

class Formatters {

    /**
     * Format prices
     * @param String $price
     * @return String $formattedPrice
     *
     */
    public static function priceFormatter(String $price) : String
    {
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
    public static function stateColor(String $state) : String
    {
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

    /**
     * Format prices
     * @param bool $enabled
     * @return String $enabledString
     */
    public static function enabledFormatterString(bool $enabled) : String
    {
        if($enabled) {
            return 'true';
        } else {
            return 'false';
        }
    }

    /**
     * Format prices
     * @param String $enabled
     * @return bool $enabledString
     */
    public static function enabledFormatterBool(String $enabled) : bool
    {
        if($enabled == 'true') {
            return '1';
        } else {
            return '0';
        }
    }

    /**
     * Format prices
     * @param int|null $val
     * @return int $val
     */
    public static function NullOrZero(?int $val) : int
    {
        if($val == null) {
            return 0;
        } else {
            return $val;
        }
    }

    /**
     * @param String $image_path
     * @return String $image_path
     */
    public static function imageLink(String $image_path) : ?String
    {
        if ($image_path == 'http://tecfever.test/images/main/IND.png') {
            return null;
        } else {
            return  substr($image_path, 29);
        }
    }
}
