<?php

namespace Sokil\IsoCodes\Database\HistoricCountries;

use Sokil\IsoCodes\Database\HistoricCountries;

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
     * @var int|null
     */
    public $numericCode;

    /**
     * Country constructor.
     * @param string $name
     * @param string $alpha4
     * @param string $alpha3
     * @param string $alpha2
     * @param string $withdrawalDate
     * @param int|null $numericCode
     */
    public function __construct(
        $name,
        $alpha4,
        $alpha3,
        $alpha2,
        $withdrawalDate,
        $numericCode = null
    ) {
        $this->name = $name;
        $this->alpha4 = $alpha4;
        $this->alpha3 = $alpha3;
        $this->alpha2 = $alpha2;
        $this->withdrawalDate = $withdrawalDate;
        $this->numericCode = $numericCode;
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
                HistoricCountries::getISONumber(),
                $this->name
            );
        }

        return $this->localName;
    }

    /**
     * @return string
     */
    public function getAlpha4()
    {
        return $this->alpha4;
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
    public function getAlpha2()
    {
        return $this->alpha2;
    }

    /**
     * @return string
     */
    public function getWithdrawalDate()
    {
        return $this->withdrawalDate;
    }

    /**
     * @return int|null
     */
    public function getNumericCode()
    {
        return $this->numericCode;
    }
}
