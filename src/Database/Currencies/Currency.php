<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\Database\Currencies;

use Sokil\IsoCodes\Database\Currencies;
use Sokil\IsoCodes\TranslationDriver\TranslatorInterface;

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
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(
        TranslatorInterface $translator,
        string $name,
        string $letterCode,
        int $numericCode
    ) {
        $this->translator = $translator;
        $this->name = $name;
        $this->letterCode = $letterCode;
        $this->numericCode = $numericCode;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLocalName(): string
    {
        if ($this->localName === null) {
            $this->localName = $this->translator->translate(
                Currencies::getISONumber(),
                $this->name
            );
        }

        return $this->localName;
    }

    public function getLetterCode(): string
    {
        return $this->letterCode;
    }

    public function getNumericCode(): int
    {
        return $this->numericCode;
    }
}
