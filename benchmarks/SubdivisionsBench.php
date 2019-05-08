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
    public function benchGetByCode(array $params): void
    {
        /** @var Subdivisions|SubdivisionsPartitioned $database */
        $database = new $params['database'];

        $database->getByCode('UA-05');
        $database->getByCode('UA-07');
        $database->getByCode('UA-40');
        $database->getByCode('UA-44');
        $database->getByCode('Unknown');
    }

    /**
     * @ParamProviders({"databaseProvider"})
     * @Revs(100)
     * @Iterations(2)
     */
    public function benchGetAllByCountryCode(array $params): void
    {
        /** @var Subdivisions|SubdivisionsPartitioned $database */
        $database = new $params['database'];

        $database->getAllByCountryCode('UA');
        $database->getAllByCountryCode('PH');
        $database->getAllByCountryCode('CZ');
        $database->getAllByCountryCode('LV');
        $database->getAllByCountryCode('Unknown');
    }
}
