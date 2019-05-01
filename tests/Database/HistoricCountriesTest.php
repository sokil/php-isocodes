<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\IsoCodesFactory;
use Sokil\IsoCodes\Database\HistoricCountries\Country;
use PHPUnit\Framework\TestCase;

class HistoricCountriesTest extends TestCase
{
    public function testIterator(): void
    {
        $isoCodes = new IsoCodesFactory();

        $countries = $isoCodes->getHistoricCountries();

        foreach ($countries as $country) {
            $this->assertInstanceOf(
                Country::class,
                $country
            );
        }
    }

    public function testGetByAlpha4(): void
    {
        $isoCodes = new IsoCodesFactory();

        $countries = $isoCodes->getHistoricCountries();
        $country = $countries->getByAlpha4('ZRCD');

        $this->assertInstanceOf(
            Country::class,
            $country
        );
        
        $this->assertEquals(
            'Zaire, Republic of',
            $country->getName()
        );

        $this->assertEquals(
            'ZRCD',
            $country->getAlpha4()
        );

        $this->assertEquals(
            'ZAR',
            $country->getAlpha3()
        );

        $this->assertEquals(
            'ZR',
            $country->getAlpha2()
        );

        $this->assertEquals(
            '1997-07-14',
            $country->getWithdrawalDate()
        );

        $this->assertSame(
            180,
            $country->getNumericCode()
        );
    }
    
    public function testGetLocalByAlpha4(): void
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        setlocale(LC_ALL, 'uk_UA.UTF-8');
        
        $isoCodes = new IsoCodesFactory();

        $countries = $isoCodes->getHistoricCountries();
        $country = $countries->getByAlpha4('ZRCD');

        $this->assertInstanceOf(
            Country::class,
            $country
        );

        $this->assertEquals(
            'Республіка Заїр',
            $country->getLocalName()
        );
    }
    
    public function testGetByAlpha3(): void
    {
        $isoCodes = new IsoCodesFactory();

        $countries = $isoCodes->getHistoricCountries();
        $country = $countries->getByAlpha3('ZAR');

        $this->assertInstanceOf(
            Country::class,
            $country
        );

        $this->assertEquals(
            'Zaire, Republic of',
            $country->getName()
        );
    }
    
    public function testGetLocalByAlpha3(): void
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        setlocale(LC_ALL, 'uk_UA.UTF-8');
        
        $isoCodes = new IsoCodesFactory();

        $countries = $isoCodes->getHistoricCountries();
        $country = $countries->getByAlpha3('ZAR');

        $this->assertInstanceOf(
            Country::class,
            $country
        );

        $this->assertEquals(
            'Республіка Заїр',
            $country->getLocalName()
        );
    }
    
    public function testGetByNumericCode(): void
    {
        $isoCodes = new IsoCodesFactory();

        $countries = $isoCodes->getHistoricCountries();
        $country = $countries->getByNumericCode(180);

        $this->assertInstanceOf(
            Country::class,
            $country
        );

        $this->assertEquals(
            'Zaire, Republic of',
            $country->getName()
        );
    }
    
    public function testGetLocalByNumericCode(): void
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        setlocale(LC_ALL, 'uk_UA.UTF-8');
        
        $isoCodes = new IsoCodesFactory();

        $countries = $isoCodes->getHistoricCountries();
        $country = $countries->getByNumericCode(180);

        $this->assertInstanceOf(
            Country::class,
            $country
        );

        $this->assertEquals(
            'Республіка Заїр',
            $country->getLocalName()
        );
    }
}
