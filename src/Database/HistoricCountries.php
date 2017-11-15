<?php

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractDatabase;
use Sokil\IsoCodes\Database\HistoricCountries\Country;

class HistoricCountries extends AbstractDatabase
{
    /**
     * @return string
     */
    public static function getISONumber()
    {
        return '3166-3';
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
            $entry['alpha_4'],
            $entry['alpha_3'],
            $entry['alpha_2'],
            $entry['withdrawal_date'],
            !empty($entry['numeric']) ? (int)$entry['numeric'] : null
        );
    }

    /**
     * @return array
     */
    protected function getIndexDefinition()
    {
        return [
            'alpha_4',
            'alpha_3',
            'alpha_2',
            'numeric'
        ];
    }

    /**
     * @param string $code
     *
     * @return null|Country
     */
    public function getByAlpha4($code)
    {
        return $this->find('alpha_4', $code);
    }

    /**
     * @param string $code
     *
     * @return null|Country
     */
    public function getByAlpha3($code)
    {
        return $this->find('alpha_3', $code);
    }

    /**
     * @param string $code
     *
     * @return null|Country
     */
    public function getByAlpha2($code)
    {
        return $this->find('alpha_2', $code);
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
