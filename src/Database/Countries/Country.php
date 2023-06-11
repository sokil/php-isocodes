<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\Database\Countries;

use Sokil\IsoCodes\Database\Countries;
use Sokil\IsoCodes\TranslationDriver\TranslatorInterface;

class Country
{
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
    private $alpha2;

    /**
     * @var string
     */
    private $alpha3;

    /**
     * @var string
     */
    private $numericCode;

    /**
     * Emoji of country flag
     *
     * @var string
     */
    private $flag;

    /**
     * @var string
     */
    private $officialName;

    /**
     * @var string
     */
    private $commonName;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(
        TranslatorInterface $translator,
        string $name,
        string $alpha2,
        string $alpha3,
        string $numericCode,
        string $flag,
        ?string $officialName = null,
        ?string $commonName = null
    ) {
        $this->translator = $translator;
        $this->name = $name;
        $this->alpha2 = $alpha2;
        $this->alpha3 = $alpha3;
        $this->numericCode = $numericCode;
        $this->flag = $flag;
        $this->officialName = $officialName;
        $this->commonName = $commonName;
    }

    public function getAlpha2(): string
    {
        return $this->alpha2;
    }

    public function getAlpha3(): string
    {
        return $this->alpha3;
    }

    public function getNumericCode(): string
    {
        return $this->numericCode;
    }

    /**
     * @return string
     */
    public function getFlag(): string
    {
        return $this->flag;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLocalName(): string
    {
        if ($this->localName === null) {
            $this->localName = $this->translator->translate(
                Countries::getISONumber(),
                $this->name
            );
        }

        return $this->localName;
    }

    public function getOfficialName(): ?string
    {
        return $this->officialName;
    }

    public function getCommonName(): ?string
    {
        return $this->commonName;
    }
}
