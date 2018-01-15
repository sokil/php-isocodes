<?php

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\Database\Territory\Territory;
use Sokil\IsoCodes\IsoCodesFactory;

class TerritoryLanguagesTest extends \PHPUnit_Framework_TestCase
{
    public function testIterator()
    {
        $isoCodes = new IsoCodesFactory();
        $territories = $isoCodes->getTerritoryLanguages();
        foreach ($territories as $territory) {
            $this->assertInstanceOf(
                Territory::class,
                $territory
            );
        }

        $this->assertInternalType('array', $territories->toArray());
        $this->assertGreaterThan(0, count($territories));
    }

    public function testGetByAlpha2()
    {
        $isoCodes = new IsoCodesFactory();

        $territories = $isoCodes->getTerritoryLanguages();
        $territory = $territories->getByAlpha2('UA');

        $this->assertInstanceOf(
            Territory::class,
            $territory
        );

        print_r($territory->languages());
    }
}
