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
     * Country constructor.
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

    public function languages()
    {
        return $this->languages;
    }
}
