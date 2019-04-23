<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractNotPartitionedDatabase;
use Sokil\IsoCodes\Database\Countries\Country;

class Countries extends AbstractNotPartitionedDatabase
{
    public static function getISONumber(): string
    {
        return '3166-1';
    }

    /**
     * @param string[] $entry
     */
    protected function arrayToEntry(array $entry): Country
    {
        return new Country(
            $entry['name'],
            $entry['alpha_2'],
            $entry['alpha_3'],
            (int)$entry['numeric'],
            !empty($entry['official_name']) ? $entry['official_name'] : null
        );
    }

    /**
     * @return string[]
     */
    protected function getIndexDefinition(): array
    {
        return [
            'alpha_2',
            'alpha_3',
            'numeric'
        ];
    }

    public function getByAlpha2(string $alpha2): ?Country
    {
        return $this->find('alpha_2', $alpha2);
    }

    public function getByAlpha3(string $alpha3): ?Country
    {
        return $this->find('alpha_3', $alpha3);
    }

    public function getByNumericCode(int $code): ?Country
    {
        return $this->find('numeric', $code);
    }
}
