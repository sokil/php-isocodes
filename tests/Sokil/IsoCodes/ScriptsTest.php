<?php

namespace Sokil\IsoCodes;

class ScriptsTest extends \PHPUnit_Framework_TestCase
{        
    public function testEntryClass()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $scripts = $isoCodes->getScripts();
        
        $this->assertInstanceOf('\Sokil\IsoCodes\Scripts\Script', $scripts->getByAlpha4('Aghb'));
    }
    
    public function testGetByAlpha4()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $scripts = $isoCodes->getScripts();
        
        $this->assertEquals('Caucasian Albanian', $scripts->getByAlpha4('Aghb')->name);
    }
    
    public function testGetLocalByAlpha4()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        var_dump(setlocale(LC_ALL, 'uk_UA.UTF-8'));
        
        $isoCodes = new \Sokil\IsoCodes;
        $scripts = $isoCodes->getScripts();
        
        $this->assertEquals('кавказька албанська', $scripts->getByAlpha4('Aghb')->getLocalName());
    }
        
    public function testGetByNumericCode()
    {
        $isoCodes = new \Sokil\IsoCodes;
        $scripts = $isoCodes->getScripts();
        
        $this->assertEquals('Caucasian Albanian', $scripts->getByNumericCode('239')->name);
    }
    
    public function testGetLocalByAlpha3()
    {
        putenv('LANGUAGE=uk_UA.UTF-8');
        putenv('LC_ALL=uk_UA.UTF-8');
        var_dump(setlocale(LC_ALL, 'uk_UA.UTF-8'));
        
        $isoCodes = new \Sokil\IsoCodes;
        $scripts = $isoCodes->getScripts();
        
        $this->assertEquals('кавказька албанська', $scripts->getByNumericCode('239')->getLocalName());
    }
}