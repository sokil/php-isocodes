<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\Database\Subdivisions;
use Sokil\IsoCodes\Database\SubdivisionsPartitioned;
use Sokil\IsoCodes\IsoCodesFactory;

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
        (new $params['database'])->toArray();
    }

    /**
     * @ParamProviders({"databaseProvider"})
     * @Revs(100)
     * @Iterations(2)
     */
    public function benchNonPartitionedGetAllByCountryCode(array $params): void
    {
        (new $params['database'])->getAllByCountryCode('UA');
    }
}
