<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\Database\Subdivisions;
use Sokil\IsoCodes\Database\SubdivisionsPartitioned;

class SubdivisionsBench
{
    public function databaseProvider(): array
    {
        return [
            'non_partitioned' => [
                'database' => Subdivisions::class
            ],
            'partitioned' => [
                'database' => SubdivisionsPartitioned::class,
            ],
        ];
    }

    /**
     * @ParamProviders({"databaseProvider"})
     * @Revs(100)
     * @Iterations(1)
     */
    public function benchIterator(array $params): void
    {
        /** @var Subdivisions|SubdivisionsPartitioned $database */
        $database = new $params['database'];

        $database->toArray();
    }

    /**
     * @ParamProviders({"databaseProvider"})
     * @Revs(100)
     * @Iterations(2)
     */
    public function benchGetByCodeSameCode(array $params): void
    {
        /** @var Subdivisions|SubdivisionsPartitioned $database */
        $database = new $params['database'];

        $database->getByCode('UA-43');
        $database->getByCode('UA-43');
        $database->getByCode('UA-43');
        $database->getByCode('UA-43');
        $database->getByCode('UA-43');
    }

    /**
     * @ParamProviders({"databaseProvider"})
     * @Revs(100)
     * @Iterations(2)
     */
    public function benchGetAllByCountryCodeSameAlpha2CountryCode(array $params): void
    {
        /** @var Subdivisions|SubdivisionsPartitioned $database */
        $database = new $params['database'];

        $database->getAllByCountryCode('UA');
        $database->getAllByCountryCode('UA');
        $database->getAllByCountryCode('UA');
        $database->getAllByCountryCode('UA');
        $database->getAllByCountryCode('UA');
    }

    /**
     * @ParamProviders({"databaseProvider"})
     * @Revs(100)
     * @Iterations(2)
     */
    public function benchGetAllByCountryCodeDiffAlpha2CountryCode(array $params): void
    {
        /** @var Subdivisions|SubdivisionsPartitioned $database */
        $database = new $params['database'];

        $database->getAllByCountryCode('UA');
        $database->getAllByCountryCode('PH');
        $database->getAllByCountryCode('CZ');
        $database->getAllByCountryCode('LV');
        $database->getAllByCountryCode('GB');
    }

}
