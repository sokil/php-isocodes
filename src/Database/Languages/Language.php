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
    private $invertedName;

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
    private $scope;

    /**
     * @var string
     */
    private $type;

    /**
     * Language constructor.
     * @param string $name
     * @param string $localName
     * @param string|null $invertedName
     * @param string|null $alpha2
     * @param string $alpha3
     * @param string $scope
     * @param string $type
     */
    public function __construct(
        $name,
        $localName,
        $invertedName,
        $alpha2,
        $alpha3,
        $scope,
        $type
    ) {
        $this->name = $name;
        $this->localName = $localName;
        $this->invertedName = $invertedName;
        $this->alpha2 = $alpha2;
        $this->alpha3 = $alpha3;
        $this->scope = $scope;
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
}
