<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Database\Countries;

use Sokil\IsoCodes\Database\Countries;

class Country
{
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
     * @var string
     */
    private $officialName;

    /**
     * Country constructor.
     */
    public function __construct(
        string $name,
        string $alpha2,
        string $alpha3,
        int $numericCode,
        ?string $officialName = null
    ) {
        $this->name = $name;
        $this->alpha2 = $alpha2;
        $this->alpha3 = $alpha3;
        $this->numericCode = $numericCode;
        $this->officialName = $officialName;
    }

    public function getAlpha2(): string
    {
        return $this->alpha2;
    }

    public function getAlpha3(): string
    {
        return $this->alpha3;
    }

    public function getNumericCode(): int
    {
        return $this->numericCode;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLocalName(): string
    {
        if ($this->localName === null) {
            $this->localName = dgettext(
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
}
