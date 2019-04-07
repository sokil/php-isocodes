<?php

namespace Sokil\IsoCodes\Database\Scripts;

use Sokil\IsoCodes\Database\Scripts;

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
     * @var integer
     */
    private $numericCode;

    /**
     * Script constructor.
     * @param string $name
     * @param string $alpha4
     * @param int $numericCode
     */
    public function __construct(
        $name,
        $alpha4,
        $numericCode
    ) {
        $this->name = $name;
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
        if ($this->localName === null) {
            $this->localName = dgettext(
                Scripts::getISONumber(),
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
     * @return int
     */
    public function getNumericCode()
    {
        return $this->numericCode;
    }
}
