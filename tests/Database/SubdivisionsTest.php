<?php

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\IsoCodesFactory;
use Sokil\IsoCodes\Database\Subdivisions\Subdivision;
use PHPUnit\Framework\TestCase;

class SubdivisionsTest extends TestCase
{
    public function testIterator()
    {
        $isoCodes = new IsoCodesFactory();

        $subDivisions = $isoCodes->getSubdivisions();

        foreach ($subDivisions as $subDivision) {
            $this->assertInstanceOf(
                Subdivision::class,
                $subDivision
            );
        }
    }

    public function testGetByCode()
    {
        $isoCodes = new IsoCodesFactory();

        $subDivisions = $isoCodes->getSubdivisions();
        $subDivision = $subDivisions->getByCode('UA-43');

        $this->assertInstanceOf(
            Subdivision::class,
            $subDivision
        );

        $this->assertEquals(
            'UA-43',
            $subDivision->getCode()
        );

        $this->assertEquals(
            'Respublika Krym',
            $subDivision->getName()
        );

        $this->assertEquals(
            'Автономна Республіка Крим',
            $subDivision->getLocalName()
        );

        $this->assertEquals(
            'Autonomous republic',
            $subDivision->getType()
        );

        $this->assertEquals(
            null,
            $subDivision->getParent()
        );
    }

    public function testGetAllByCountryCode()
    {
        $isoCodes = new IsoCodesFactory();

        $subDivisionDatabase = $isoCodes->getSubdivisions();
        $subDivisions = $subDivisionDatabase->getAllByCountryCode('UA');

        $this->assertIsArray($subDivisions);

        $this->assertArrayHasKey('UA-43', $subDivisions);

        $subDivision = $subDivisions['UA-43'];

        $this->assertInstanceOf(
            Subdivision::class,
            $subDivision
        );

        $this->assertEquals(
            'Автономна Республіка Крим',
            $subDivision->getLocalName()
        );
    }
}
