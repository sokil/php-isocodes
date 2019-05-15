<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractPartitionedDatabase;
use Sokil\IsoCodes\Database\Languages\Language;

class LanguagesPartitioned extends AbstractPartitionedDatabase
{
    public static function getISONumber(): string
    {
        return '639-3';
    }

    /**
     * @param string[] $entry
     */
    protected function arrayToEntry(array $entry): Language
    {
        return new Language(
            $entry['name'],
            $entry['alpha_3'],
            $entry['scope'],
            $entry['type'],
            !empty($entry['inverted_name']) ? $entry['inverted_name'] : null,
            !empty($entry['alpha_2']) ? $entry['alpha_2'] : null
        );
    }

    public function getByAlpha2(string $alpha2): ?Language
    {
        return $this->find('alpha_2', $alpha2);
    }

    public function getByAlpha3(string $alpha3): ?Language
    {
        return $this->find('alpha_3', $alpha3);
    }
}
