<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\Database\Languages\Language;

interface LanguagesInterface extends \Iterator, \Countable
{
    public function getByAlpha2(string $alpha2): ?Language;

    public function getByAlpha3(string $alpha3): ?Language;
}
