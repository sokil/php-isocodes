<?php

namespace Sokil\IsoCodes\Databases;

class HistoricCountriesTest extends \PHPUnit_Framework_TestCase
{        
    public function testEntryClass()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertInstanceOf(
            '\Sokil\IsoCodes\Database\HistoricCountries\Country',
            $countries->getByAlpha4('ZRCD')
        );
    }
    
    public function testGetByAlpha4()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertEquals(
            'Zaire, Republic of',
            $countries->getByAlpha4('ZRCD')->getName()
        );
    }
    
    public function testGetLocalByAlpha4()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        setlocale(LC_ALL, 'uk_UA.UTF-8');
        
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertEquals(
            'Республіка Заїр',
            $countries->getByAlpha4('ZRCD')->getLocalName()
        );
    }
    
    public function testGetByAlpha3()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertEquals(
            'Zaire, Republic of',
            $countries->getByAlpha3('ZAR')->getName()
        );
    }
    
    public function testGetLocalByAlpha3()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        setlocale(LC_ALL, 'uk_UA.UTF-8');
        
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertEquals(
            'Республіка Заїр',
            $countries->getByAlpha3('ZAR')->getLocalName()
        );
    }
    
    public function testGetByNumericCode()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertEquals(
            'Zaire, Republic of',
            $countries->getByNumericCode(180)->getName()
        );
    }
    
    public function testGetLocalByNumericCode()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        setlocale(LC_ALL, 'uk_UA.UTF-8');
        
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertEquals(
            'Республіка Заїр',
            $countries->getByNumericCode(180)->getLocalName()
        );
    }
}
