<?php

namespace Sokil\IsoCodes;

class SubdivisionsTest extends \PHPUnit_Framework_TestCase
{        
    public function testEntryClass()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $subdivisions = $isoCodes->getSubdivisions();
        
        $this->assertInstanceOf('\Sokil\IsoCodes\Subdivisions\Subdivision', $subdivisions->getByAlpha2('UA'));
    }
    
    public function testGetByAlpha2()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $subdivisions = $isoCodes->getSubdivisions();
        
        $this->assertArrayHasKey('UA-56', $subdivisions->getByAlpha2('UA')->getList());
        
        $this->assertTrue(in_array("Rivnens'ka Oblast'", $subdivisions->getByAlpha2('UA')->getList()));
    }
    
    public function testGetLocalByAlpha2()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        setlocale(LC_ALL, 'uk_UA.UTF-8');
        
        $isoCodes = new \Sokil\IsoCodes;
        $subdivisions = $isoCodes->getSubdivisions();
        
        $this->assertArrayHasKey('UA-56', $subdivisions->getByAlpha2('UA')->getList());
        
        $this->assertTrue(in_array("Рівненська область", $subdivisions->getByAlpha2('UA')->getLocalList()));
    }
}