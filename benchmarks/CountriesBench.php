<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\IsoCodesFactory;
use Sokil\IsoCodes\TranslationDriver\SymfonyTranslationDriver;

class CountriesBench
{
    /**
     * @Revs(500)
     * @Iterations(2)
     */
    public function benchIterator(): void
    {
        $isoCodes = new IsoCodesFactory();
        $isoCodes->getCountries()->toArray();
    }

    /**
     * @Revs(500)
     * @Iterations(2)
     */
    public function benchSymfonyTranslation(): void
    {
        $driver = new SymfonyTranslationDriver();
        $driver->setLocale('uk_UA');

        $isoCodes = new IsoCodesFactory(
            null,
            $driver
        );

        $countries = $isoCodes->getCountries();
        $country = $countries->getByAlpha2('UA');

        $country->getLocalName();
    }

    /**
     * @Revs(500)
     * @Iterations(2)
     */
    public function benchGettextExtTranslation(): void
    {
        $isoCodes = new IsoCodesFactory();

        $countries = $isoCodes->getCountries();
        $country = $countries->getByAlpha2('UA');

        $country->getLocalName();
    }
}
