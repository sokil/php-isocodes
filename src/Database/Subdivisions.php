<?php

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractDatabase;
use Sokil\IsoCodes\Database\Subdivisions\Subdivision;

class Subdivisions extends AbstractDatabase
{
    public static function getISONumber()
    {
        return '3166-2';
    }

    /**
     * @param array $entry
     *
     * @return Subdivision
     */
    protected function arrayToEntry(array $entry)
    {
        return new Subdivision(
            $entry['name'],
            $entry['code'],
            $entry['type'],
            !empty($entry['parent']) ? $entry['parent'] : null
        );
    }

    /**
     * @return array
     */
    protected function getIndexDefinition()
    {
        return [
            'code',
            'country_code' => [['code', 2], 'code'],
        ];
    }

    /**
     * @param $code
     * @return Subdivision
     */
    public function getByCode($code)
    {
        return $this->find('code', $code);
    }

    /**
     * @param $code
     * @return Subdivision[]
     */
    public function getAllByCountryCode($code)
    {
        return $this->find('country_code', $code);
    }
}
