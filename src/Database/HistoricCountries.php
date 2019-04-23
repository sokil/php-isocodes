<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractNotPartitionedDatabase;
use Sokil\IsoCodes\Database\HistoricCountries\Country;

class HistoricCountries extends AbstractNotPartitionedDatabase
{
    public static function getISONumber(): string
    {
        return '3166-3';
    }

    /**
     * @param string[] $entry
     */
    protected function arrayToEntry(array $entry): Country
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
     * @return string[]
     */
    protected function getIndexDefinition(): array
    {
        return [
            'alpha_4',
            'alpha_3',
            'alpha_2',
            'numeric'
        ];
    }

    public function getByAlpha4(string $code): ?Country
    {
        return $this->find('alpha_4', $code);
    }

    public function getByAlpha3(string $code): ?Country
    {
        return $this->find('alpha_3', $code);
    }

    public function getByAlpha2(string $code): ?Country
    {
        return $this->find('alpha_2', $code);
    }

    public function getByNumericCode(int $code): ?Country
    {
        return $this->find('numeric', $code);
    }
}
