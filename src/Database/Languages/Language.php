<?php

namespace Sokil\IsoCodes\Database\Languages;

class Language
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
    private $alpha3;

    /**
     * @var string
     */
    private $scope;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $invertedName;

    /**
     * @var string
     */
    private $alpha2;

    /**
     * Language constructor.
     * @param string $name
     * @param string $localName
     * @param string $alpha3
     * @param string $scope
     * @param string $type
     * @param string|null $invertedName
     * @param string|null $alpha2
     */
    public function __construct(
        $name,
        $localName,
        $alpha3,
        $scope,
        $type,
        $invertedName = null,
        $alpha2 = null
    ) {
        $this->name = $name;
        $this->localName = $localName;
        $this->alpha3 = $alpha3;
        $this->scope = $scope;
        $this->type = $type;
        $this->invertedName = $invertedName;
        $this->alpha2 = $alpha2;
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
    public function getAlpha3()
    {
        return $this->alpha3;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
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
    public function getInvertedName()
    {
        return $this->invertedName;
    }

    /**
     * @return string|null
     */
    public function getAlpha2()
    {
        return $this->alpha2;
    }
}
