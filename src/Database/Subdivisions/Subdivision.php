<?php

namespace Sokil\IsoCodes\Database\Subdivisions;

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
    private $parent;

    /**
     * @var string
     */
    private $type;

    /**
     * Subdivision constructor.
     * @param string $name
     * @param string $localName
     * @param string $code
     * @param string $parent
     * @param string $type
     */
    public function __construct(
        $name,
        $localName,
        $code,
        $parent,
        $type
    ) {
        $this->name = $name;
        $this->localName = $localName;
        $this->code = $code;
        $this->parent = $parent;
        $this->type = $type;
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
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
