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
    private $sortedLanguages;

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
    public function getSortedLanguages()
    {
        if ($this->sortedLanguages === null) {
            $arr = $this->languages;
            ksort($arr);
            $arr = array_map(function ($k, $v) {
                $v['language'] = $k;

                return $v;
            }, array_keys($arr), array_values($arr));
            usort($arr, function ($x, $y) {
                if ($x['percent'] === $y['percent']) {
                    return 0;
                }

                return $x['percent'] > $y['percent'] ? -1 : 1;
            });
            $this->sortedLanguages = array_combine(array_map(function ($x) {
                return $x['language'];
            }, $arr), $arr);
        }

        return $this->sortedLanguages;
    }

    /**
     * @return array
     */
    public function getOfficialLanguages()
    {
        if ($this->officialLanguages === null) {
            $this->officialLanguages = array_keys(array_filter($this->getSortedLanguages(), function ($v) {
                return $v['official'];
            }));
        }

        return $this->officialLanguages;
    }

    /**
     * @return array
     */
    public function getUnofficialLanguages()
    {
        if ($this->unofficialLanguages === null) {
            $this->officialLanguages = array_keys(array_filter($this->getSortedLanguages(), function ($v) {
                return !$v['official'];
            }));
        }

        return $this->unofficialLanguages;
    }
}
