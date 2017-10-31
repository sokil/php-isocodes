<?php

namespace Sokil\IsoCodes\Database\HistoricCountries;

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
    public $numericCode;

    /**
     * @var string
     */
    private $withdrawalDate;

    /**
     * Country constructor.
     * @param string $name
     * @param string $localName
     * @param string $alpha4
     * @param string $alpha3
     * @param string $alpha2
     * @param string|null $numericCode
     * @param string $withdrawalDate
     */
    public function __construct(
        $name,
        $localName,
        $alpha4,
        $alpha3,
        $alpha2,
        $numericCode,
        $withdrawalDate
    ) {
        $this->name = $name;
        $this->localName = $localName;
        $this->alpha4 = $alpha4;
        $this->alpha3 = $alpha3;
        $this->alpha2 = $alpha2;
        $this->numericCode = $numericCode;
        $this->withdrawalDate = $withdrawalDate;
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
     * @return string|null
     */
    public function getNumericCode()
    {
        return $this->numericCode;
    }

    /**
     * @return string
     */
    public function getWithdrawalDate()
    {
        return $this->withdrawalDate;
    }
}
