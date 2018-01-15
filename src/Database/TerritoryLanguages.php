<?php

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractDatabase;
use Sokil\IsoCodes\Database\Territory\Territory;

class TerritoryLanguages extends AbstractDatabase
{
    public static function getISONumber()
    {
        return 'territory_languages';
    }

    /**
     * @param array $entry
     *
     * @return Territory
     */
    protected function arrayToEntry(array $entry)
    {
        return new Territory(
            $entry['alpha_2'],
            $entry['languages']
        );
    }

    /**
     * @return array
     */
    protected function getIndexDefinition()
    {
        return [
            'alpha_2',
        ];
    }

    /**
     * @param string $alpha2
     *
     * @return null|Territory
     */
    public function getByAlpha2($alpha2)
    {
        return $this->find('alpha_2', $alpha2);
    }


}
