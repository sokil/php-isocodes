<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractNotPartitionedDatabase;
use Sokil\IsoCodes\Database\Subdivisions\Subdivision;

class Subdivisions extends AbstractNotPartitionedDatabase implements SubdivisionsInterface
{
    public static function getISONumber(): string
    {
        return '3166-2';
    }

    /**
     * @param mixed[] $entry
     */
    protected function arrayToEntry(array $entry): Subdivision
    {
        return new Subdivision(
            $entry['name'],
            $entry['code'],
            $entry['type'],
            !empty($entry['parent']) ? $entry['parent'] : null
        );
    }

    /**
     * @return mixed[]
     */
    protected function getIndexDefinition(): array
    {
        return [
            'code',
            'country_code' => [['code', 2], 'code'],
        ];
    }

    /**
     * @param string $subdivisionCode in format "alpha2country-subdivision", e.g. "UA-43"
     */
    public function getByCode(string $subdivisionCode): ?Subdivision
    {
        return $this->find('code', $subdivisionCode);
    }

    /**
     * @param string $alpha2CountryCode e.g. "UA"
     *
     * @return Subdivision[]
     */
    public function getAllByCountryCode(string $alpha2CountryCode): array
    {
        $subdivisions = $this->find('country_code', $alpha2CountryCode);

        if (empty($subdivisions)) {
            $subdivisions = [];
        }

        return $subdivisions;
    }
}
