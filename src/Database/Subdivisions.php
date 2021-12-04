<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractNotPartitionedDatabase;
use Sokil\IsoCodes\Database\Subdivisions\Subdivision;

/**
 * @method Subdivision|Subdivision[]|null find(string $indexedFieldName, string $fieldValue)
 */
class Subdivisions extends AbstractNotPartitionedDatabase implements SubdivisionsInterface
{
    /**
     * ISO Standard Number
     *
     * @psalm-pure
     */
    public static function getISONumber(): string
    {
        return '3166-2';
    }

    /**
     * @param array<string, string> $entry
     */
    protected function arrayToEntry(array $entry): Subdivision
    {
        return new Subdivision(
            $this->translationDriver,
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
        /** @var Subdivision|null $subdivision */
        $subdivision = $this->find('code', $subdivisionCode);

        return $subdivision;
    }

    /**
     * @param string $alpha2CountryCode e.g. "UA"
     *
     * @return Subdivision[]
     */
    public function getAllByCountryCode(string $alpha2CountryCode): array
    {
        /** @var Subdivision[]|null $subdivisions */
        $subdivisions = $this->find('country_code', $alpha2CountryCode);

        if (empty($subdivisions)) {
            $subdivisions = [];
        }

        return $subdivisions;
    }
}
