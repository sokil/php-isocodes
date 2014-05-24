<?php

namespace Sokil\IsoCodes;

class CountriesTest extends \PHPUnit_Framework_TestCase
{        
    public function testGetByAlpha2()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getCountries();
        
        $this->assertEquals('Ukraine', $countries->getByAlpha2('UA'));
    }
    
    public function testGetLocalByAlpha2()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        var_dump(setlocale(LC_ALL, 'uk_UA.UTF-8'));
        
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getCountries();
        
        $this->assertEquals('Україна', $countries->getLocalByAlpha2('UA'));
    }
        
    public function testGetByAlpha3()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getCountries();
        
        $this->assertEquals('Ukraine', $countries->getByAlpha3('UKR'));
    }
    
    public function testGetlocalByAlpha3()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getCountries();
        
        $this->assertEquals('Україна', $countries->getLocalByAlpha3('UKR'));
    }
    
    public function testGetByNumericCode()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getCountries();
        
        $this->assertEquals('Ukraine', $countries->getByNumericCode('804'));
    }
    
    public function testGetLocalByNumericCode()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getCountries();
        
        $this->assertEquals('Україна', $countries->getLocalByNumericCode('804'));
    }
    
    public function testGetAll()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getCountries();
        
        $this->assertTrue(in_array('Ukraine', $countries->getAll()));
    }
    
    public function testGetAllLocal()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $countries = $isoCodes->getCountries();
        
        $this->assertTrue(in_array('Україна', $countries->getAllLocal()));
    }
}