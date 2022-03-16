<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\TranslationDriver;

use PHPUnit\Framework\TestCase;
use Sokil\IsoCodes\IsoCodesFactory;

class SymfonyTranslationDriverTest extends TestCase
{
    public function testTranslateEn()
    {
        $driver = new SymfonyTranslationDriver();
        $driver->setLocale('en');

        $isoCodesFactory = new IsoCodesFactory(
            null,
            $driver
        );

        $countries = $isoCodesFactory->getCountries();
        $country = $countries->getByAlpha2('UA');

        $this->assertEquals(
            'Ukraine',
            $country->getLocalName()
        );
    }

    public function testTranslateUkUa()
    {
        $driver = new SymfonyTranslationDriver();
        $driver->setLocale('uk_UA');

        $isoCodes = new IsoCodesFactory(
            null,
            $driver
        );

        $countries = $isoCodes->getCountries();
        $country = $countries->getByAlpha2('UA');

        $this->assertEquals(
            'Україна',
            $country->getLocalName()
        );
    }
}
