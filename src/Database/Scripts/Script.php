<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\Database\Scripts;

use Sokil\IsoCodes\Database\Scripts;
use Sokil\IsoCodes\TranslationDriver\TranslatorInterface;

class Script
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
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
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(
        TranslatorInterface $translator,
        string $name,
        string $alpha4,
        string $numericCode
    ) {
        $this->translator = $translator;
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
            $this->localName = $this->translator->translate(
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

    public function getNumericCode(): string
    {
        return $this->numericCode;
    }
}
