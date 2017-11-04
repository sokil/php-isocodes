<?php

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\Database\Subdivisions\Subdivision;
use Sokil\IsoCodes\IsoCodesFactory;

class SubdivisionsTest extends \PHPUnit_Framework_TestCase
{        
    public function testEntryClass()
    {
        $isoCodes = new IsoCodesFactory();
        $subdivisions = $isoCodes->getSubdivisions();
        
        $this->assertInstanceOf(
            Subdivision::class,
            current($subdivisions->getAllByCountryCode('UA'))
        );
    }
}
