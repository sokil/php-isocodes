<?php

namespace Sokil\IsoCodes\Database\Languages;

use Sokil\IsoCodes\Database\Languages;

class Language
{
    /**
     * @see https://iso639-3.sil.org/about/scope
     */
    const SCOPE_COLLECTIVE = 'C';
    const SCOPE_INDIVIDUAL = 'I';
    const SCOPE_LOCAL = 'L';
    const SCOPE_MACROLANGUAGE = 'M';
    const SCOPE_SPECIAL = 'S';

    /**
     * @see https://iso639-3.sil.org/about/types
     */
    const TYPE_ANCIENT = 'A';
    const TYPE_CONSTRUCTED = 'C';
    const TYPE_EXTINCT = 'E';
    const TYPE_GENETIC = 'GENETIC'; // not supported
    const TYPE_GENETIC_ANCIENT = 'GENETIC_ANCIENT'; // not supported
    const TYPE_GENETIC_LIKE = 'GENETIC_LIKE'; // not supported
    const TYPE_GEOGRAPHIC = 'GEOGRAPHIC'; // not supported
    const TYPE_HISTORICAL = 'H';
    const TYPE_LIVING = 'L';
    const TYPE_SPECIAL = 'S';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $localName;

    /**
     * @var string
     */
    private $alpha3;

    /**
     * Scope of denotation
     *
     * One of self::SCOPE_*
     *
     * @see https://iso639-3.sil.org/about/scope
     *
     * @var string
     */
    private $scope;

    /**
     * Type of language
     *
     * One of TYPE_*
     *
     * @see https://iso639-3.sil.org/about/types
     *
     * @var string
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
     * @param string $name
     * @param string $alpha3
     * @param string $scope
     * @param string $type
     * @param string|null $invertedName
     * @param string|null $alpha2
     */
    public function __construct(
        $name,
        $alpha3,
        $scope,
        $type,
        $invertedName = null,
        $alpha2 = null
    ) {
        $this->name = $name;
        $this->alpha3 = $alpha3;
        $this->scope = $scope;
        $this->type = $type;
        $this->invertedName = $invertedName;
        $this->alpha2 = $alpha2;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLocalName()
    {
        if ($this->localName === null) {
            $this->localName = dgettext(
                Languages::getISONumber(),
                $this->name
            );
        }

        return $this->localName;
    }

    /**
     * @return string
     */
    public function getAlpha3()
    {
        return $this->alpha3;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getInvertedName()
    {
        return $this->invertedName;
    }

    /**
     * @return string|null
     */
    public function getAlpha2()
    {
        return $this->alpha2;
    }
}
