<?php

namespace Sokil\IsoCodes;

class CurrenciesTest extends \PHPUnit_Framework_TestCase
{        
    public function testEntryClass()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $currencies = $isoCodes->getCurrencies();
        
        $this->assertInstanceOf('\Sokil\IsoCodes\Currencies\Currency', $currencies->getByLetterCode('CZK'));
    }
    
    public function testGetByLetterCode()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $currencies = $isoCodes->getCurrencies();
        
        $this->assertEquals('Czech Koruna', $currencies->getByLetterCode('CZK')->getName());
    }
    
    public function testGetLocalByLetterCode()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        setlocale(LC_ALL, 'uk_UA.UTF-8');
        
        $isoCodes = new \Sokil\IsoCodes;
        $currencies = $isoCodes->getCurrencies();
        
        $this->assertEquals('Чеська крона', $currencies->getByLetterCode('CZK')->getLocalName());
    }
        
    public function testGetByNumericCode()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $currencies = $isoCodes->getCurrencies();
        
        $this->assertEquals('Czech Koruna', $currencies->getByNumericCode(203)->getName());
    }
    
    public function testGetLocalByNumericCode()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        setlocale(LC_ALL, 'uk_UA.UTF-8');
        
        $isoCodes = new \Sokil\IsoCodes;
        $currencies = $isoCodes->getCurrencies();
        
        $this->assertEquals('Чеська крона', $currencies->getByNumericCode(203)->getLocalName());
    }
}