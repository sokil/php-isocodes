<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\Database\Languages;
use Sokil\IsoCodes\Database\LanguagesPartitioned;

class LanguagesBench
{
    public function databaseProvider(): array
    {
        return [
            'non_partitioned' => [
                'database' => Languages::class,
            ],
            'partitioned' => [
                'database' => LanguagesPartitioned::class,
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
        /** @var Languages|LanguagesPartitioned $database */
        $database = new $params['database'];

        $database->toArray();
    }

    /**
     * @ParamProviders({"databaseProvider"})
     * @Revs(100)
     * @Iterations(1)
     */
    public function benchGetBySameAlpha2(array $params): void
    {
        /** @var Languages|LanguagesPartitioned $database */
        $database = new $params['database'];

        $database->getByAlpha2('sv');
        $database->getByAlpha2('sv');
        $database->getByAlpha2('sv');
        $database->getByAlpha2('sv');
        $database->getByAlpha2('sv');
    }

    /**
     * @ParamProviders({"databaseProvider"})
     * @Revs(100)
     * @Iterations(1)
     */
    public function benchGetBySameAlpha3(array $params): void
    {
        /** @var LanguagesPartitioned|Languages $database */
        $database = new $params['database'];

        $database->getByAlpha3('zpz');
        $database->getByAlpha3('zpz');
        $database->getByAlpha3('zpz');
        $database->getByAlpha3('zpz');
        $database->getByAlpha3('zpz');
    }

}
