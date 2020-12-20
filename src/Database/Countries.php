<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractNotPartitionedDatabase;
use Sokil\IsoCodes\Database\Countries\Country;

/**
 * @method Country|null find(string $indexedFieldName, string $fieldValue)
 */
class Countries extends AbstractNotPartitionedDatabase
{
    /**
     * ISO Standard Number
     *
     * @psalm-pure
     */
    public static function getISONumber(): string
    {
        return '3166-1';
    }

    /**
     * @param array<string, string> $entry
     */
    protected function arrayToEntry(array $entry): Country
    {
        return new Country(
            $this->translationDriver,
            $entry['name'],
            $entry['alpha_2'],
            $entry['alpha_3'],
            $entry['numeric'],
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

    /**
     * Using int code argument is deprecated due to it can be with leading 0 (e.g. '042').
     * Please, use numeric strings.
     *
     * @param string|int $code
     *
     * @return Country|null
     *
     * @throws \TypeError
     */
    public function getByNumericCode($code): ?Country
    {
        if (!is_numeric($code)) {
            throw new \TypeError('Argument must be int or string');
        }

        return $this->find('numeric', (string)$code);
    }
}
