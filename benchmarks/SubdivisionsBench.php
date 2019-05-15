<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\Database\Subdivisions;
use Sokil\IsoCodes\Database\SubdivisionsPartitioned;

class SubdivisionsBench
{
    public function databaseProvider(): array
    {
        $countries = \array_column(
            \json_decode(
                file_get_contents(__DIR__ . '/../databases/iso_3166-1.json'),
                true
            )['3166-1'],
            'alpha_2'
        );

        return [
            'non_partitioned' => [
                'database' => Subdivisions::class,
                'countries' => $countries,
            ],
            'partitioned' => [
                'database' => SubdivisionsPartitioned::class,
                'countries' => $countries,
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

        foreach ($params['countries'] as $countryAlpha2) {
            $database->getAllByCountryCode($countryAlpha2);
        }
    }

}
