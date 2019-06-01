<?php
/**
 * Created by PhpStorm.
 * User: sokil
 * Date: 01.06.19
 * Time: 15:42
 */

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\Database\Subdivisions\Subdivision;

interface SubdivisionsInterface extends \Iterator, \Countable
{
    /**
     * @param string $subdivisionCode in format "alpha2country-subdivision", e.g. "UA-43"
     */
    public function getByCode(string $subdivisionCode): ?Subdivision;

    /**
     * @param string $alpha2CountryCode e.g. "UA"
     *
     * @return Subdivision[]
     */
    public function getAllByCountryCode(string $alpha2CountryCode): array;
}