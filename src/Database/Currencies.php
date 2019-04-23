<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractNotPartitionedDatabase;
use Sokil\IsoCodes\Database\Currencies\Currency;

class Currencies extends AbstractNotPartitionedDatabase
{
    public static function getISONumber(): string
    {
        return '4217';
    }

    /**
     * @param mixed[] $entry
     */
    protected function arrayToEntry(array $entry): Currency
    {
        return new Currency(
            $entry['name'],
            $entry['alpha_3'],
            (int)$entry['numeric']
        );
    }

    /**
     * @return string[]
     */
    protected function getIndexDefinition(): array
    {
        return [
            'alpha_3',
            'numeric'
        ];
    }

    public function getByLetterCode(string $code): ?Currency
    {
        return $this->find('alpha_3', $code);
    }

    public function getByNumericCode(int $code): ?Currency
    {
        return $this->find('numeric', $code);
    }
}
