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

    /**
     * A basic unit test example.
     *
     * @return void
     * @test
     */
    public function aImagePathIsFormattedSuccessful()
    {
        // Acts
        $imageFormatted1 = Formatters::imageLink('http://tecfever.test/images/main/IND.png');
        $imageFormatted2 = Formatters::imageLink('http://tecfever.test/storage/images/products/codex.png');

        // Asserts
        $this->assertEquals(null, $imageFormatted1);
        $this->assertEquals('images/products/codex.png', $imageFormatted2);
    }
}
