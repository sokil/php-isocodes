<?php

namespace Sokil\IsoCodes;

class HistoricCurrenciesTest extends \PHPUnit_Framework_TestCase
{        
    public function testEntryClass()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $currencies = $isoCodes->getHistoricCurrencies();
        
        $this->assertInstanceOf('\Sokil\IsoCodes\HistoricCurrencies\Currency', $currencies->getByLetterCode('YUN'));
    }
    
    public function testGetByLetterCode()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $currencies = $isoCodes->getHistoricCurrencies();
        
        $this->assertEquals('Yugoslavian Dinar', $currencies->getByLetterCode('YUN')->getName());
    }
    
    public function testGetLocalByLetterCode()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        var_dump(setlocale(LC_ALL, 'uk_UA.UTF-8'));
        
        $isoCodes = new \Sokil\IsoCodes;
        $currencies = $isoCodes->getHistoricCurrencies();
        
        $this->assertEquals('Югославський динар', $currencies->getByLetterCode('YUN')->getLocalName());
    }
        
    public function testGetByNumericCode()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $currencies = $isoCodes->getHistoricCurrencies();
        
        $this->assertEquals('Yugoslavian Dinar', $currencies->getByNumericCode(890)->getName());
    }
    
    public function testGetLocalByNumericCode()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        var_dump(setlocale(LC_ALL, 'uk_UA.UTF-8'));
        
        $isoCodes = new \Sokil\IsoCodes;
        $currencies = $isoCodes->getHistoricCurrencies();
        
        $this->assertEquals('Югославський динар', $currencies->getByNumericCode(890)->getLocalName());
    }
}