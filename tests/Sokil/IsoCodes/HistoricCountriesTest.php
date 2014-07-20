<?php

namespace Sokil\IsoCodes;

class HistoricCountriesTest extends \PHPUnit_Framework_TestCase
{        
    public function testEntryClass()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertInstanceOf('\Sokil\IsoCodes\HistoricCountries\Country', $countries->getByAlpha4('ZRCD'));
    }
    
    public function testGetByAlpha4()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertEquals('Zaire, Republic of', $countries->getByAlpha4('ZRCD')->names);
    }
    
    public function testGetLocalByAlpha4()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        var_dump(setlocale(LC_ALL, 'uk_UA.UTF-8'));
        
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertEquals('Республіка Заїр', $countries->getByAlpha4('ZRCD')->getLocalNames());
    }
    
    public function testGetByAlpha3()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertEquals('Zaire, Republic of', $countries->getByAlpha3('ZAR')->names);
    }
    
    public function testGetLocalByAlpha3()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        var_dump(setlocale(LC_ALL, 'uk_UA.UTF-8'));
        
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertEquals('Республіка Заїр', $countries->getByAlpha3('ZAR')->getLocalNames());
    }
    
    public function testGetByNumericCode()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertEquals('Zaire, Republic of', $countries->getByNumericCode(180)->names);
    }
    
    public function testGetLocalByNumericCode()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        var_dump(setlocale(LC_ALL, 'uk_UA.UTF-8'));
        
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertEquals('Республіка Заїр', $countries->getByNumericCode(180)->getLocalNames());
    }
}