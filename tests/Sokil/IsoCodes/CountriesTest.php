<?php

namespace Sokil\IsoCodes;

class CountriesTest extends \PHPUnit_Framework_TestCase
{
    private static $countries;
    
    public static function setUpBeforeClass()
    {
        $isoCodes = new \Sokil\IsoCodes;
        self::$countries = $isoCodes->getCountries();
    }
    
    public function testGetByAlpha2()
    {
        $this->assertEquals('Ukraine', self::$countries->getByAlpha2('UA'));
    }
        
    public function testGetByAlpha3()
    {
        $this->assertEquals('Ukraine', self::$countries->getByAlpha3('UKR'));
    }
    
    public function testGetByNumericCode()
    {
        $this->assertEquals('Ukraine', self::$countries->getByAlpha2('804'));
    }
    
    public function testGetAll()
    {
        $this->assertTrue(in_array('Ukraine', self::$countries->getAll()));
    }
}