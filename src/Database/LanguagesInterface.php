<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\Database\Languages\Language;
use Sokil\IsoCodes\Database\LanguagesAlpha2\Language as LanguageAlpha2;

interface LanguagesInterface extends \Iterator, \Countable
{
    public function getByAlpha2(string $alpha2): ?LanguageAlpha2;

    public function getByAlpha3(string $alpha3): ?Language;
}
