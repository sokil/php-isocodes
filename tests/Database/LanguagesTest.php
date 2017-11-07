<?php

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\IsoCodesFactory;
use Sokil\IsoCodes\Database\Languages\Language;

class LanguagesTest extends \PHPUnit_Framework_TestCase
{
    public function testIterator()
    {
        $isoCodes = new IsoCodesFactory();

        $languages = $isoCodes->getLanguages();

        foreach ($languages as $language) {
            $this->assertInstanceOf(
                Language::class,
                $language
            );
        }
    }

    public function testGetByAlpha2()
    {
        $isoCodes = new IsoCodesFactory();

        $languages = $isoCodes->getLanguages();
        $language = $languages->getByAlpha2('uk');
        
        $this->assertInstanceOf(
            Language::class,
            $language
        );

        $this->assertEquals(
            'Ukrainian',
            $language->getName()
        );

        $this->assertEquals(
            'українська',
            $language->getLocalName()
        );

        $this->assertSame(
            'ukr',
            $language->getAlpha3()
        );

        $this->assertSame(
            'I',
            $language->getScope()
        );

        $this->assertSame(
            'L',
            $language->getType()
        );

        $this->assertSame(
            null,
            $language->getInvertedName()
        );

        $this->assertSame(
            'uk',
            $language->getAlpha2()
        );
    }
        
    public function testGetByAlpha3()
    {
        $isoCodes = new IsoCodesFactory();

        $languages = $isoCodes->getLanguages();
        $language = $languages->getByAlpha3('ukr');
        
        $this->assertEquals(
            'Ukrainian',
            $language->getName()
        );

        $this->assertEquals(
            'українська',
            $language->getLocalName()
        );
    }
}
