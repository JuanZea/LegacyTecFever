<?php

namespace Tests\Unit;

use App\Helpers\Formatters;
use PHPUnit\Framework\TestCase;

class FormattersTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     * @test
     */
    public function aPriceIsFormattedSuccessful()
    {
        // Acts
        $priceFormatted = Formatters::priceFormatter('1800000');

        // Asserts
        $this->assertEquals('$ 1.800.000', $priceFormatted);
    }
}
