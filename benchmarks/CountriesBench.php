<?php

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\IsoCodesFactory;

class CountriesBench
{
    /**
     * @Warmup(1)
     * @Revs(1000)
     * @Iterations(2)
     */
    public function benchIterator()
    {
        $isoCodes = new IsoCodesFactory();
        $isoCodes->getCountries()->toArray();
    }
}
