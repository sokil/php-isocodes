<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\AbstractDatabase;
use Sokil\IsoCodes\Database\Subdivisions;
use Sokil\IsoCodes\Database\SubdivisionsPartitioned;
use Sokil\IsoCodes\IsoCodesFactory;
use Sokil\IsoCodes\Database\Subdivisions\Subdivision;
use PHPUnit\Framework\TestCase;

class SubdivisionsTest extends TestCase
{
    public function subDivisionsDatabaseProvider(): array
    {
        $isoCodes = new IsoCodesFactory();

        return [
            'non_partitioned' => [
                $isoCodes->getSubdivisions(),
            ],
            'partitioned' => [
                $isoCodes->getSubdivisionsPartitioned(),
            ],
        ];
    }

    /**
     * @param Subdivisions|SubdivisionsPartitioned $subDivisionDatabase
     *
     * @dataProvider subDivisionsDatabaseProvider
     */
    public function testIterator(AbstractDatabase $subDivisionDatabase): void
    {
        foreach ($subDivisionDatabase as $subDivision) {
            $this->assertInstanceOf(
                Subdivision::class,
                $subDivision
            );
        }
    }

    /**
     * @param Subdivisions|SubdivisionsPartitioned $subDivisionDatabase
     *
     * @dataProvider subDivisionsDatabaseProvider
     */
    public function testIteratorByMethods(AbstractDatabase $subDivisionDatabase): void
    {
        $subDivisionDatabase->rewind();
        $subDivision = $subDivisionDatabase->current();

        $this->assertInstanceOf(
            Subdivision::class,
            $subDivision
        );
    }

    /**
     * @param Subdivisions|SubdivisionsPartitioned $subDivisionDatabase
     *
     * @dataProvider subDivisionsDatabaseProvider
     */
    public function testGetByCode(AbstractDatabase $subDivisionDatabase): void
    {
        $subDivision = $subDivisionDatabase->getByCode('UA-43');

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

    /**
     * @param Subdivisions|SubdivisionsPartitioned $subDivisionDatabase
     *
     * @dataProvider subDivisionsDatabaseProvider
     */
    public function testGetAllByCountryCode(AbstractDatabase $subDivisionDatabase): void
    {
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
