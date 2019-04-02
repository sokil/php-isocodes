<?php

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\IsoCodesFactory;

class SubdivisionsBench
{
    /**
     * @Revs(100)
     * @Iterations(1)
     */
    public function benchIterator()
    {
        $isoCodes = new IsoCodesFactory();
        $isoCodes->getSubdivisions()->toArray();
    }

    /**
     * @Revs(100)
     * @Iterations(2)
     */
    public function benchGetAllByCountryCode()
    {
        $isoCodes = new IsoCodesFactory();
        $subDivisionDatabase = $isoCodes->getSubdivisions();
        $subDivisionDatabase->getAllByCountryCode('UA');
    }
}
