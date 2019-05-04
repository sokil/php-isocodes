<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\IsoCodesFactory;

class CountriesBench
{
    /**
     * @Revs(500)
     * @Iterations(2)
     */
    public function benchIterator(): void
    {
        $isoCodes = new IsoCodesFactory();
        $isoCodes->getCountries()->toArray();
    }
}
