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
     * @param string $name
     * @param string $alpha2
     * @param string $alpha3
     * @param int $numericCode
     * @param string|null $officialName
     */
    public function __construct(
        $name,
        $alpha2,
        $alpha3,
        $numericCode,
        $officialName = null
    ) {
        $this->name = $name;
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
     * @return int
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
    public function getLocalName()
    {
        if ($this->localName === null) {
            $this->localName = dgettext(
                Countries::getISONumber(),
                $this->name
            );
        }

        return $this->localName;
    }

    /**
     * @return string|null
     */
    public function getOfficialName()
    {
        return $this->officialName;
    }
}
