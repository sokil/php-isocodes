<?php

namespace Sokil\IsoCodes\Database\Territory;

class Territory
{
    /**
     * @var string
     */
    private $alpha2;

    /**
     * @var array
     */
    private $languages;

    /**
     * @var array
     */
    private $officialLanguages;

    /**
     * @var array
     */
    private $unofficialLanguages;

    /**
     * Territory constructor.
     *
     * @param string $alpha2
     * @param array $languages
     */
    public function __construct(
        $alpha2,
        $languages
    ) {
        $this->alpha2 = $alpha2;
        $this->languages = $languages;
    }

    /**
     * @return string
     */
    public function getAlpha2()
    {
        return $this->alpha2;
    }

    /**
     * @return array
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * @return array
     */
    public function getOfficialLanguages()
    {
        if ($this->officialLanguages === null) {
            $this->officialLanguages = array_filter($this->getLanguages(), function ($v) {
                return $v['official'];
            });
        }

        return $this->officialLanguages;
    }

    /**
     * @return array
     */
    public function getUnofficialLanguages()
    {
        if ($this->unofficialLanguages === null) {
            $this->officialLanguages = array_filter($this->getLanguages(), function ($v) {
                return !$v['official'];
            });
        }

        return $this->unofficialLanguages;
    }
}
