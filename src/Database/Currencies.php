<?php

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractDatabase;
use Sokil\IsoCodes\Database\Currencies\Currency;

class Currencies extends AbstractDatabase
{
    /**
     * @return string
     */
    public function getISONumber()
    {
        return '4217';
    }

    /**
     * @param array $entry
     *
     * @return Currency
     */
    protected function arrayToEntry(array $entry)
    {
        return new Currency(
            $entry['name'],
            $this->getLocal($entry['name']),
            $entry['alpha_3'],
            $entry['numeric']
        );
    }

    /**
     * @return array
     */
    protected function getIndexDefinition()
    {
        return [
            'alpha_3',
            'numeric'
        ];
    }

    /**
     * @param string $code
     * @return null|Currency
     */
    public function getByLetterCode($code)
    {
        return $this->find('alpha_3', $code);
    }

    /**
     * @param string $code
     * @return null|Currency
     */
    public function getByNumericCode($code)
    {
        return $this->find('numeric', $code);
    }
}
