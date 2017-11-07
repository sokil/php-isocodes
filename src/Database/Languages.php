<?php

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractDatabase;
use Sokil\IsoCodes\Database\Languages\Language;

class Languages extends AbstractDatabase
{
    /**
     * @return string
     */
    protected function getISONumber()
    {
        return '639-3';
    }

    /**
     * @param array $entry
     *
     * @return Language
     */
    protected function arrayToEntry(array $entry)
    {
        return new Language(
            $entry['name'],
            $this->getLocal($entry['name']),
            $entry['alpha_3'],
            $entry['scope'],
            $entry['type'],
            !empty($entry['inverted_name']) ? $entry['inverted_name'] : null,
            !empty($entry['alpha_2']) ? $entry['alpha_2'] : null
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
        ];
    }

    /**
     * @param string $alpha2
     *
     * @return null|Language
     */
    public function getByAlpha2($alpha2)
    {
        return $this->find('alpha_2', $alpha2);
    }

    /**
     * @param string $alpha3
     *
     * @return null|Language
     */
    public function getByAlpha3($alpha3)
    {
        return $this->find('alpha_3', $alpha3);
    }
}
