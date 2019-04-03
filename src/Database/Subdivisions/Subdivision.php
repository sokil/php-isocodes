<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Database\Subdivisions;

use Sokil\IsoCodes\Database\Subdivisions;

class Subdivision
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
     * Subdivision constructor.
     * @param string $name
     * @param string $code
     * @param string $type
     * @param string|null $parent
     */
    public function __construct(
        $name,
        $code,
        $type,
        $parent = null
    ) {
        $this->name = $name;
        $this->code = $code;
        $this->type = $type;
        $this->parent = $parent;
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
                Subdivisions::getISONumber(),
                $this->name
            );
        }

        return $this->localName;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getParent()
    {
        return $this->parent;
    }
}
