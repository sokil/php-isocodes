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
            // NOTE: omit ZZ code that is used for unspecified country
            if($territory->getAlpha2() !== 'ZZ') {
                $this->assertNotEmpty(
                    $territory->getLanguages()
                );
            }
        }

        $this->assertInternalType('array', $territories->toArray());
        $this->assertGreaterThan(0, count($territories));
    }

    public function testGetByAlpha2()
    {
        $isoCodes = new IsoCodesFactory();

        $territories = $isoCodes->getTerritoryLanguages();
        $territory = $territories->getByAlpha2('CA');

        $this->assertInstanceOf(
            Territory::class,
            $territory
        );

        $this->assertArraySubset(['en', 'fr'], $territory->getOfficialLanguages());
    }
}
