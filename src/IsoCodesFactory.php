<?php

namespace Sokil\IsoCodes;

use Sokil\IsoCodes\Database\Countries;
use Sokil\IsoCodes\Database\Currencies;
use Sokil\IsoCodes\Database\HistoricCountries;
use Sokil\IsoCodes\Database\Languages;
use Sokil\IsoCodes\Database\Scripts;
use Sokil\IsoCodes\Database\Subdivisions;

/**
 * Factory class to build ISO databases
 */
class IsoCodesFactory
{
    /**
     * @var AbstractDatabase[]
     */
    private $databases = [];

    /**
     * @param string $className
     *
     * @return AbstractDatabase
     */
    private function getDatabase($className)
    {
        if (empty($this->databases[$className])) {
            $this->databases[$className] = new $className();
        }

        return $this->databases[$className];
    }

    /**
     * ISO 3166-1
     *
     * @return Countries
     */
    public function getCountries()
    {
        return $this->getDatabase(Countries::class);
    }

    /**
     * ISO 3166-2
     *
     * @return Subdivisions
     */
    public function getSubdivisions()
    {
        return $this->getDatabase(Subdivisions::class);
    }
    
    /**
     * ISO 3166-3
     *
     * @return HistoricCountries
     */
    public function getHistoricCountries()
    {
        return $this->getDatabase(HistoricCountries::class);
    }
    
    /**
     * ISO 15924
     *
     * @return Scripts
     */
    public function getScripts()
    {
        return $this->getDatabase(Scripts::class);
    }
    
    /**
     * ISO 4217
     *
     * @return Currencies
     */
    public function getCurrencies()
    {
        return $this->getDatabase(Currencies::class);
    }
    
    /**
     * ISO 639-3
     * @return Languages
     */
    public function getLanguages()
    {
        return $this->getDatabase(Languages::class);
    }
}
