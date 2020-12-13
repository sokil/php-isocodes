<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\Database\Countries\Country;
use Sokil\IsoCodes\IsoCodesFactory;
use PHPUnit\Framework\TestCase;

class CountriesTest extends TestCase
{
    public function testIterator(): void
    {
        $isoCodes = new IsoCodesFactory();
        $countries = $isoCodes->getCountries();
        foreach ($countries as $country) {
            $this->assertInstanceOf(
                Country::class,
                $country
            );
        }

        $this->assertIsArray($countries->toArray());
        $this->assertGreaterThan(0, count($countries));
    }

    public function testGetByAlpha2(): void
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
            '804',
            $country->getNumericCode()
        );

        $this->assertEquals(
            null,
            $country->getOfficialName()
        );
    }

    public function testGetByAlpha3(): void
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

    public function getByNumericCodeDataProvider()
    {
        return [
            [
                804
            ],
            [
                '804'
            ],
        ];
    }

    /**
     * @dataProvider getByNumericCodeDataProvider
     */
    public function testGetByNumericCode($code): void
    {
        $isoCodes = new IsoCodesFactory();

        $countries = $isoCodes->getCountries();
        $country = $countries->getByNumericCode($code);

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

    public function testGetByNumericCodeNegative(): void
    {
        $this->expectException(\TypeError::class);

        $isoCodes = new IsoCodesFactory();

        $countries = $isoCodes->getCountries();
        $country = $countries->getByNumericCode('kek');
    }

    public function testGetByNumericCodeLeadingZeroes(): void
    {
        $isoCodes = new IsoCodesFactory();

        $countries = $isoCodes->getCountries();
        $country = $countries->getByNumericCode('036');

        $this->assertInstanceOf(
            Country::class,
            $country
        );

        $this->assertEquals(
            'Australia',
            $country->getName()
        );

        $this->assertSame(
            '036',
            $country->getNumericCode()
        );
    }
}
