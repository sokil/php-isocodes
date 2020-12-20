<?php

declare(strict_types=1);

namespace Sokil\IsoCodes\Database\Subdivisions;

use Sokil\IsoCodes\Database\Subdivisions;
use Sokil\IsoCodes\TranslationDriver\TranslatorInterface;

/**
 * @psalm-immutable
 */
class Subdivision
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string|null
     *
     * @psalm-allow-private-mutation
     */
    private $localName;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string|null
     */
    private $parent;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    public function __construct(
        TranslatorInterface $translator,
        string $name,
        string $code,
        string $type,
        ?string $parent = null
    ) {
        $this->translator = $translator;
        $this->name = $name;
        $this->code = $code;
        $this->type = $type;
        $this->parent = $parent;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLocalName(): string
    {
        if ($this->localName === null) {
            $this->localName = $this->translator->translate(
                Subdivisions::getISONumber(),
                $this->name
            );
        }

        return $this->localName;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getParent(): ?string
    {
        return $this->parent;
    }
}
