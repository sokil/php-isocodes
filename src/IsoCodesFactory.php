<?php
declare(strict_types=1);

namespace Sokil\IsoCodes;

use Sokil\IsoCodes\Database\Countries;
use Sokil\IsoCodes\Database\Currencies;
use Sokil\IsoCodes\Database\HistoricCountries;
use Sokil\IsoCodes\Database\Languages;
use Sokil\IsoCodes\Database\LanguagesPartitioned;
use Sokil\IsoCodes\Database\Scripts;
use Sokil\IsoCodes\Database\Subdivisions;
use Sokil\IsoCodes\Database\SubdivisionsPartitioned;

/**
 * Factory class to build ISO databases
 */
class IsoCodesFactory
{
    /**
     * Path to directory with databases
     *
     * @var string
     */
    private $baseDirectory;

    /**
     * @var AbstractDatabase[]
     */
    private $databases = [];

    public function __construct(?string $baseDirectory = null)
    {
        $this->baseDirectory = $baseDirectory;
    }

    private function getDatabase(string $className): AbstractDatabase
    {
        if (empty($this->databases[$className])) {
            $this->databases[$className] = new $className($this->baseDirectory);
        }

        return $this->databases[$className];
    }

    /**
     * ISO 3166-1
     */
    public function getCountries(): Countries
    {
        return $this->getDatabase(Countries::class);
    }

    /**
     * ISO 3166-2
     */
    public function getSubdivisions(): Subdivisions
    {
        return $this->getDatabase(Subdivisions::class);
    }

    /**
     * ISO 3166-2
     *
     * Loaded from bunch of database files instead of one single file
     */
    public function getSubdivisionsPartitioned(): SubdivisionsPartitioned
    {
        return $this->getDatabase(SubdivisionsPartitioned::class);
    }

    /**
     * ISO 3166-3
     */
    public function getHistoricCountries(): HistoricCountries
    {
        return $this->getDatabase(HistoricCountries::class);
    }

    /**
     * ISO 15924
     */
    public function getScripts(): Scripts
    {
        return $this->getDatabase(Scripts::class);
    }

    /**
     * ISO 4217
     */
    public function getCurrencies(): Currencies
    {
        return $this->getDatabase(Currencies::class);
    }

    /**
     * ISO 639-3
     */
    public function getLanguages(): Languages
    {
        return $this->getDatabase(Languages::class);
    }

    /**
     * ISO 639-3
     */
    public function getLanguagesPartitioned(): LanguagesPartitioned
    {
        return $this->getDatabase(LanguagesPartitioned::class);
    }
}
