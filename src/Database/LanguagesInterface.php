<?php
/**
 * Created by PhpStorm.
 * User: sokil
 * Date: 01.06.19
 * Time: 15:54
 */

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\Database\Languages\Language;

interface LanguagesInterface extends \Iterator, \Countable
{
    public function getByAlpha2(string $alpha2): ?Language;

    public function getByAlpha3(string $alpha3): ?Language;
}