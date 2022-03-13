<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\Database\LanguagesAlpha2;

use Sokil\IsoCodes\TranslationDriver\TranslatorInterface;

class Language extends \Sokil\IsoCodes\Database\Languages\Language
{
    /** @var string */
    private $alpha2;

    public function __construct(
        TranslatorInterface $translator,
        string $name,
        string $alpha2,
        string $alpha3,
        string $scope,
        string $type,
        ?string $invertedName = null
    ) {
        parent::__construct($translator, $name, $alpha3, $scope, $type, $invertedName, $alpha2);
        $this->alpha2 = $alpha2;
    }

    public function getAlpha2(): string
    {
        return $this->alpha2;
    }
}
