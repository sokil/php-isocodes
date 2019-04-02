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
     * @param string $subdivisionCode in format "alpha2country-subdivision", e.g. "UA-43"
     *
     * @return Subdivision
     */
    public function getByCode($subdivisionCode)
    {
        return $this->find('code', $subdivisionCode);
    }

    /**
     * @param string $alpha2CountryCode e.g. "UA"
     *
     * @return Subdivision[]
     */
    public function getAllByCountryCode($alpha2CountryCode)
    {
        return $this->find('country_code', $alpha2CountryCode);
    }
}
