<?php

namespace Sokil\IsoCodes\Database\Currencies;

use Sokil\IsoCodes\Database\Currencies;

class Currency
{
    /**
     * @var string
     */
    private $letterCode;

    /**
     * @var integer
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
     * @param string $letterCode
     * @param int $numericCode
     */
    public function __construct(
        $name,
        $letterCode,
        $numericCode
    ) {
        $this->name = $name;
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
        if ($this->localName === null) {
            $this->localName = dgettext(
                Currencies::getISONumber(),
                $this->name
            );
        }

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
