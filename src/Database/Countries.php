<?php

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractDatabase;
use Sokil\IsoCodes\Database\Countries\Country;

class Countries extends AbstractDatabase
{
    public function getISONumber()
    {
        return '3166-1';
    }

    /**
     * @param array $entry
     *
     * @return Country
     */
    protected function arrayToEntry(array $entry)
    {
        return new Country(
            $entry['name'],
            $this->getLocal($entry['name']),
            $entry['alpha_2'],
            $entry['alpha_3'],
            (int)$entry['numeric'],
            !empty($entry['official_name']) ? $entry['official_name'] : null
        );
    }

    /**
     * @return array
     */
    protected function getIndexDefinition()
    {
        return [
            'alpha_2',
            'alpha_3',
            'numeric'
        ];
    }

    /**
     * @param string $alpha2
     *
     * @return null|Country
     */
    public function getByAlpha2($alpha2)
    {
        return $this->find('alpha_2', $alpha2);
    }

    /**
     * @param string $alpha3
     *
     * @return null|Country
     */
    public function getByAlpha3($alpha3)
    {
        return $this->find('alpha_3', $alpha3);
    }

    /**
     * @param int $code
     *
     * @return null|Country
     */
    public function getByNumericCode($code)
    {
        return $this->find('numeric', $code);
    }
}
