<?php

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\Database\Countries\Country;
use \Sokil\IsoCodes\IsoCodesFactory;

class CountriesTest extends \PHPUnit\Framework\TestCase
{
    public function testIterator()
    {
        $isoCodes = new IsoCodesFactory();
        $countries = $isoCodes->getCountries();
        foreach ($countries as $country) {
            $this->assertInstanceOf(
                Country::class,
                $country
            );
        }

        $this->assertInternalType('array', $countries->toArray());
        $this->assertGreaterThan(0, count($countries));
    }

    public function testGetByAlpha2()
    {
        $isoCodes = new IsoCodesFactory();

        $countries = $isoCodes->getCountries();
        $country = $countries->getByAlpha2('UA');

        $this->assertInstanceOf(
            Country::class,
            $country
        );

        $this->assertEquals(
            'Ukraine',
            $country->getName()
        );

        $this->assertEquals(
            'Україна',
            $country->getLocalName()
        );

        $this->assertEquals(
            'UA',
            $country->getAlpha2()
        );

        $this->assertEquals(
            'UKR',
            $country->getAlpha3()
        );

        $this->assertSame(
            804,
            $country->getNumericCode()
        );

        $this->assertEquals(
            null,
            $country->getOfficialName()
        );
    }

    public function testGetByAlpha3()
    {
        $isoCodes = new IsoCodesFactory();

        $countries = $isoCodes->getCountries();
        $country = $countries->getByAlpha3('UKR');

        $this->assertInstanceOf(
            Country::class,
            $country
        );

        $this->assertEquals(
            'Ukraine',
            $country->getName()
        );

        $this->assertEquals(
            'Україна',
            $country->getLocalName()
        );
    }
    
    public function testGetByNumericCode()
    {
        $isoCodes = new IsoCodesFactory();

        $countries = $isoCodes->getCountries();
        $country = $countries->getByNumericCode('804');

        $this->assertInstanceOf(
            Country::class,
            $country
        );

        $this->assertEquals(
            'Ukraine',
            $country->getName()
        );

        $this->assertEquals(
            'Україна',
            $country->getLocalName()
        );
    }
}
