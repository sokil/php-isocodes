<?php

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\IsoCodesFactory;

class SubdivisionsBench
{
    /**
     * @Revs(500)
     * @Iterations(2)
     */
    public function benchIterator()
    {
        $isoCodes = new IsoCodesFactory();
        $isoCodes->getSubdivisions()->toArray();
    }
}
