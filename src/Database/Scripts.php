<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractNotPartitionedDatabase;
use Sokil\IsoCodes\Database\Scripts\Script;

/**
 * @method Script|null find(string $indexedFieldName, string $fieldValue)
 */
class Scripts extends AbstractNotPartitionedDatabase
{
    /**
     * ISO Standard Number
     *
     * @psalm-pure
     */
    public static function getISONumber(): string
    {
        return '15924';
    }

    /**
     * @param array<string, string> $entry
     *
     */
    protected function arrayToEntry(array $entry): Script
    {
        return new Script(
            $this->translationDriver,
            $entry['name'],
            $entry['alpha_4'],
            $entry['numeric']
        );
    }

    /**
     * @return string[]
     */
    protected function getIndexDefinition(): array
    {
        return [
            'alpha_4',
            'numeric'
        ];
    }

    public function getByAlpha4(string $alpha4): ?Script
    {
        return $this->find('alpha_4', $alpha4);
    }

    /**
     * Using int code argument is deprecated due to it can be with leading 0 (e.g. '042').
     * Please, use numeric strings.
     *
     * @param string|int $code
     *
     * @return Script|null
     *
     * @throws \TypeError
     */
    public function getByNumericCode($code): ?Script
    {
        if (!is_numeric($code)) {
            throw new \TypeError('Argument must be int or string');
        }

        return $this->find('numeric', (string)$code);
    }
}
