<?php

namespace Sokil\IsoCodes;

class LanguagesTest extends \PHPUnit_Framework_TestCase
{        
    public function testEntryClass()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $languages = $isoCodes->getLanguages();
        
        $this->assertInstanceOf('\Sokil\IsoCodes\Languages\Language', $languages->getByAlpha2('uk'));
    }
    
    public function testGetByAlpha2()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $languages = $isoCodes->getLanguages();
        
        $this->assertEquals('Ukrainian', $languages->getByAlpha2('uk')->name);
    }
    
    public function testGetLocalByAlpha2()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        var_dump(setlocale(LC_ALL, 'uk_UA.UTF-8'));
        
        $isoCodes = new \Sokil\IsoCodes;
        $languages = $isoCodes->getLanguages();
        
        $this->assertEquals('українська', $languages->getByAlpha2('uk')->getLocalName());
    }
        
    public function testGetByAlpha3()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $languages = $isoCodes->getLanguages();
        
        $this->assertEquals('Ukrainian', $languages->getByAlpha3('ukr')->name);
    }
    
    public function testGetLocalByAlpha3()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        var_dump(setlocale(LC_ALL, 'uk_UA.UTF-8'));
        
        $isoCodes = new \Sokil\IsoCodes;
        $languages = $isoCodes->getLanguages();
        
        $this->assertEquals('українська', $languages->getByAlpha3('ukr')->getLocalName());
    }
}