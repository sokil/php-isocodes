<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\Database\Languages;

use Sokil\IsoCodes\Database\Languages;
use Sokil\IsoCodes\TranslationDriver\TranslatorInterface;

class Language
{
    /**
     * @see https://iso639-3.sil.org/about/scope
     */
    public const SCOPE_COLLECTIVE = 'C';
    public const SCOPE_INDIVIDUAL = 'I';
    public const SCOPE_LOCAL = 'L';
    public const SCOPE_MACROLANGUAGE = 'M';
    public const SCOPE_SPECIAL = 'S';

    /**
     * @see https://iso639-3.sil.org/about/types
     */
    public const TYPE_ANCIENT = 'A';
    public const TYPE_CONSTRUCTED = 'C';
    public const TYPE_EXTINCT = 'E';
    public const TYPE_GENETIC = 'GENETIC'; // not supported
    public const TYPE_GENETIC_ANCIENT = 'GENETIC_ANCIENT'; // not supported
    public const TYPE_GENETIC_LIKE = 'GENETIC_LIKE'; // not supported
    public const TYPE_GEOGRAPHIC = 'GEOGRAPHIC'; // not supported
    public const TYPE_HISTORICAL = 'H';
    public const TYPE_LIVING = 'L';
    public const TYPE_SPECIAL = 'S';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     */
    private $localName;

    /**
     * @var string
     */
    private $alpha3;

    /**
     * @var string
     *
     * Scope of denotation
     *
     * One of self::SCOPE_*
     *
     * @see https://iso639-3.sil.org/about/scope
     */
    private $scope;

    /**
     * @var string
     *
     * Type of language
     *
     * One of TYPE_*
     *
     * @see https://iso639-3.sil.org/about/types
     */
    private $type;

    /**
     * @var string
     */
    private $invertedName;

    /**
     * @var string
     */
    private $alpha2;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(
        TranslatorInterface $translator,
        string $name,
        string $alpha3,
        string $scope,
        string $type,
        ?string $invertedName = null,
        ?string $alpha2 = null
    ) {
        $this->translator = $translator;
        $this->name = $name;
        $this->alpha3 = $alpha3;
        $this->scope = $scope;
        $this->type = $type;
        $this->invertedName = $invertedName;
        $this->alpha2 = $alpha2;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLocalName(): string
    {
        if ($this->localName === null) {
            $this->localName = $this->translator->translate(
                Languages::getISONumber(),
                $this->name
            );
        }

        return $this->localName;
    }

    public function getAlpha3(): string
    {
        return $this->alpha3;
    }

    public function getScope(): string
    {
        return $this->scope;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getInvertedName(): ?string
    {
        return $this->invertedName;
    }

    public function getAlpha2(): ?string
    {
        return $this->alpha2;
    }
}
