<?php

namespace Sokil\IsoCodes\Database\Countries;

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
     * @param string $name
     * @param string $localName
     * @param string $alpha2
     * @param string $alpha3
     * @param string $numericCode
     * @param string $officialName
     */
    public function __construct(
        $name,
        $localName,
        $alpha2,
        $alpha3,
        $numericCode,
        $officialName
    ) {
        $this->name = $name;
        $this->localName = $localName;
        $this->alpha2 = $alpha2;
        $this->alpha3 = $alpha3;
        $this->numericCode = $numericCode;
        $this->officialName = $officialName;
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
    public function getAlpha3()
    {
        return $this->alpha3;
    }

    /**
     * @return string
     */
    public function getNumericCode()
    {
        return $this->numericCode;
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
    public function getOfficialName()
    {
        return $this->officialName;
    }
    
    public function getLocalName()
    {
        return $this->localName;
    }
}
