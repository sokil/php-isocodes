<?php

namespace Sokil\IsoCodes\Database\Scripts;

class Script
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
    private $numericCode;

    /**
     * Script constructor.
     * @param string $name
     * @param string $localName
     * @param string $alpha4
     * @param string $numericCode
     */
    public function __construct(
        $name,
        $localName,
        $alpha4,
        $numericCode
    ) {
        $this->name = $name;
        $this->localName = $localName;
        $this->alpha4 = $alpha4;
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
    public function getAlpha4()
    {
        return $this->alpha4;
    }

    /**
     * @return string
     */
    public function getNumericCode()
    {
        return $this->numericCode;
    }
}
