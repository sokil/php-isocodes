<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractNotPartitionedDatabase;
use Sokil\IsoCodes\Database\Scripts\Script;

class Scripts extends AbstractNotPartitionedDatabase
{
    public static function getISONumber(): string
    {
        return '15924';
    }

    /**
     * @param string[] $entry
     */
    protected function arrayToEntry(array $entry): Script
    {
        return new Script(
            $entry['name'],
            $entry['alpha_4'],
            (int)$entry['numeric']
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

    public function getByNumericCode(int $code): ?Script
    {
        return $this->find('numeric', $code);
    }
}
