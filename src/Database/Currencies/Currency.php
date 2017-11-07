<?php

namespace Sokil\IsoCodes\Database\Currencies;

class Currency
{
    /**
     * @var string
     */
    private $letterCode;

    /**
     * @var int
     */
    private $numericCode;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $localName;

    /**
     * @param string $name
     * @param string $localName
     * @param string $letterCode
     * @param int $numericCode
     */
    public function __construct(
        $name,
        $localName,
        $letterCode,
        $numericCode
    ) {
        $this->name = $name;
        $this->localName = $localName;
        $this->letterCode = $letterCode;
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
        return $this->localName;
    }

    /**
     * @return string
     */
    public function getLetterCode()
    {
        return $this->letterCode;
    }

    /**
     * @return int
     */
    public function getNumericCode()
    {
        return $this->numericCode;
    }
}
