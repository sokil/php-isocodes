<?php
declare(strict_types=1);

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
     */
    public function __construct(
        string $name,
        string $alpha4,
        int $numericCode
    ) {
        $this->name = $name;
        $this->alpha4 = $alpha4;
        $this->numericCode = $numericCode;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function getLocalName(): string
    {
        if ($this->localName === null) {
            $this->localName = dgettext(
                Scripts::getISONumber(),
                $this->name
            );
        }

        return $this->localName;
    }

    public function getAlpha4(): string
    {
        return $this->alpha4;
    }

    public function getNumericCode(): int
    {
        return $this->numericCode;
    }
}
