<?php

namespace Sokil\IsoCodes;

class HistoricCountriesTest extends \PHPUnit_Framework_TestCase
{        
    public function testEntryClass()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertInstanceOf('\Sokil\IsoCodes\HistoricCountries\Country', $countries->getByCode('AD-05'));
    }
    
    public function testGetByCode()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertEquals('Ordino', $countries->getByCode('AD-05')->name);
    }
    
    public function testGetLocalByCode()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        var_dump(setlocale(LC_ALL, 'uk_UA.UTF-8'));
        
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getHistoricCountries();
        
        $this->assertEquals('Ордіно', $countries->getByCode('AD-05')->getLocalName());
    }
}