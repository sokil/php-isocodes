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
        $territory = $territories->getByAlpha2('CA');

        $this->assertInstanceOf(
            Territory::class,
            $territory
        );

        $languages = $territory->getOfficialLanguages();
        $this->assertInternalType('array', $languages);
        $this->assertNotEmpty($languages);
        foreach ($languages as $v) {
            $this->assertArraySubset(['lang', 'official', 'percent'], array_keys($v));
        }

        $this->assertArraySubset(['en', 'fr'], array_map(function ($x) {
            return $x['lang'];
        }, $languages));
    }

    public function testLanguages()
    {
        $isoCodes = new IsoCodesFactory();
        $territories = $isoCodes->getTerritoryLanguages();
        foreach ($territories as $territory) {
            $this->assertInstanceOf(
                Territory::class,
                $territory
            );
            // NOTE: ZZ code is used for unspecified country
            if ($territory->getAlpha2() !== 'ZZ') {
                $this->assertNotEmpty(
                    $territory->getLanguages()
                );

                $this->assertGreaterThanOrEqual(
                    count($territory->getUnofficialLanguages()),
                    count($territory->getOfficialLanguages())
                );
            } else {
                $this->assertEmpty(
                    $territory->getLanguages()
                );

                $this->assertEmpty(
                    count($territory->getOfficialLanguages())
                );

                $this->assertEmpty(
                    count($territory->getUnofficialLanguages())
                );
            }
        }
    }
}
