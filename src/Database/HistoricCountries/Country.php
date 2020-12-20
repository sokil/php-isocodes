<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\Database\HistoricCountries;

use Sokil\IsoCodes\Database\HistoricCountries;
use Sokil\IsoCodes\TranslationDriver\TranslatorInterface;

/**
 * @psalm-immutable
 */
class Country
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     *
     * @psalm-allow-private-mutation
     */
    private $localName;

    /**
     * @var string
     */
    private $alpha4;

    /**
     * @var string
     */
    private $alpha3;

    /**
     * @var string
     */
    private $alpha2;

    /**
     * @var string
     */
    private $withdrawalDate;

    /**
     * @var string|null
     */
    public $numericCode;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(
        TranslatorInterface $translator,
        string $name,
        string $alpha4,
        string $alpha3,
        string $alpha2,
        string $withdrawalDate,
        ?string $numericCode = null
    ) {
        $this->translator = $translator;
        $this->name = $name;
        $this->alpha4 = $alpha4;
        $this->alpha3 = $alpha3;
        $this->alpha2 = $alpha2;
        $this->withdrawalDate = $withdrawalDate;
        $this->numericCode = $numericCode;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLocalName(): string
    {
        if ($this->localName === null) {
            $this->localName = $this->translator->translate(
                HistoricCountries::getISONumber(),
                $this->name
            );
        }

        return $this->localName;
    }

    public function getAlpha4(): string
    {
        return $this->alpha4;
    }

    public function getAlpha3(): string
    {
        return $this->alpha3;
    }

    public function getAlpha2(): string
    {
        return $this->alpha2;
    }

    public function getWithdrawalDate(): string
    {
        return $this->withdrawalDate;
    }

    public function getNumericCode(): ?string
    {
        return $this->numericCode;
    }
}
