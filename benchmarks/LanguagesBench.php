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
    public function benchGetByDiffAlpha2(array $params): void
    {
        /** @var Languages|LanguagesPartitioned $database */
        $database = new $params['database'];

        $database->getByAlpha2('sv');
        $database->getByAlpha2('ku');
        $database->getByAlpha2('ny');
        $database->getByAlpha2('az');
        $database->getByAlpha2('tw');
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

        $database->getByAlpha2('zpz');
        $database->getByAlpha2('zpz');
        $database->getByAlpha2('zpz');
        $database->getByAlpha2('zpz');
        $database->getByAlpha2('zpz');
    }

    /**
     * @ParamProviders({"databaseProvider"})
     * @Revs(100)
     * @Iterations(1)
     */
    public function benchGetByDiffAlpha3(array $params): void
    {
        /** @var LanguagesPartitioned|Languages $database */
        $database = new $params['database'];

        $database->getByAlpha2('svx');
        $database->getByAlpha2('kuz');
        $database->getByAlpha2('nyy');
        $database->getByAlpha2('azz');
        $database->getByAlpha2('twy');
    }

}
