<?php
declare(strict_types=1);

namespace Sokil\IsoCodes;

use Sokil\IsoCodes\Database\Countries;
use Sokil\IsoCodes\Database\Currencies;
use Sokil\IsoCodes\Database\HistoricCountries;
use Sokil\IsoCodes\Database\Languages;
use Sokil\IsoCodes\Database\LanguagesInterface;
use Sokil\IsoCodes\Database\LanguagesPartitioned;
use Sokil\IsoCodes\Database\Scripts;
use Sokil\IsoCodes\Database\Subdivisions;
use Sokil\IsoCodes\Database\SubdivisionsInterface;
use Sokil\IsoCodes\Database\SubdivisionsPartitioned;

/**
 * Factory class to build ISO databases
 */
class IsoCodesFactory
{
    /**
     * Database splits into partition files.
     *
     * Fetching some entry will load only little part of database.
     * Loaded entries not stored statically.
     *
     * This scenario may be useful when just few entries need
     * to be loaded, for example on web request when one entry fetched.
     *
     * This may require a lot of file read operations.
     */
    public const OPTIMISATION_MEMORY = 1;

    /**
     * Entire database loaded into memory from single JSON file once.
     *
     * All entries created and stored into RAM. Next read of save
     * entry will just return it without io operations with files and building objects.
     *
     * This scenario may be useful for daemons to decrease file operations,
     * or when most entries will be fetched from database.
     *
     * This may require a lot of RAM for storing all entries.
     */
    public const OPTIMISATION_IO = 2;

    /**
     * Path to directory with databases
     *
     * @var string
     */
    private $baseDirectory;

    public function __construct(?string $baseDirectory = null)
    {
        $this->baseDirectory = $baseDirectory;
    }

    /**
     * ISO 3166-1
     */
    public function getCountries(): Countries
    {
        return new Countries($this->baseDirectory);
    }

    /**
     * ISO 3166-2
     *
     * @param int $optimisation One of self::OPTIMISATION_* constants
     */
    public function getSubdivisions(int $optimisation = self::OPTIMISATION_MEMORY): SubdivisionsInterface
    {
        switch ($optimisation) {
            case self::OPTIMISATION_MEMORY:
                $database = new SubdivisionsPartitioned($this->baseDirectory);
                break;
            case self::OPTIMISATION_IO:
                $database = new Subdivisions($this->baseDirectory);
                break;
            default:
                throw new \InvalidArgumentException('Invalid optimisation specified');
        }

        return $database;
    }

    /**
     * ISO 3166-3
     */
    public function getHistoricCountries(): HistoricCountries
    {
        return new HistoricCountries($this->baseDirectory);
    }

    /**
     * ISO 15924
     */
    public function getScripts(): Scripts
    {
        return new Scripts($this->baseDirectory);
    }

    /**
     * ISO 4217
     */
    public function getCurrencies(): Currencies
    {
        return new Currencies($this->baseDirectory);
    }

    /**
     * ISO 639-3
     *
     * @param int $optimisation One of self::OPTIMISATION_* constants
     */
    public function getLanguages(int $optimisation = self::OPTIMISATION_MEMORY): LanguagesInterface
    {
        switch ($optimisation) {
            case self::OPTIMISATION_MEMORY:
                $database = new LanguagesPartitioned($this->baseDirectory);
                break;
            case self::OPTIMISATION_IO:
                $database = new Languages($this->baseDirectory);
                break;
            default:
                throw new \InvalidArgumentException('Invalid optimisation specified');
        }

        return $database;
    }
}
