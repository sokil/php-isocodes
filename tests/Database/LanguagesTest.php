<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\AbstractDatabase;
use Sokil\IsoCodes\IsoCodesFactory;
use Sokil\IsoCodes\Database\Languages\Language;
use PHPUnit\Framework\TestCase;

class LanguagesTest extends TestCase
{
    public function languageDatabaseProvider()
    {
        $isoCodes = new IsoCodesFactory();

        return [
            'non_partitioned' => [
                $isoCodes->getLanguages(IsoCodesFactory::OPTIMISATION_IO),
            ],
            'partitioned' => [
                $isoCodes->getLanguages(IsoCodesFactory::OPTIMISATION_MEMORY),
            ],
        ];
    }

    /**
     * @dataProvider languageDatabaseProvider
     */
    public function testIterator(AbstractDatabase $languageDatabase): void
    {
        foreach ($languageDatabase as $language) {
            $this->assertInstanceOf(
                Language::class,
                $language
            );
        }
    }

    /**
     * @dataProvider languageDatabaseProvider
     */
    public function testGetByAlpha2(AbstractDatabase $languageDatabase): void
    {
        $language = $languageDatabase->getByAlpha2('uk');
        
        $this->assertInstanceOf(
            Language::class,
            $language
        );

        $this->assertEquals(
            'Ukrainian',
            $language->getName()
        );

        $this->assertEquals(
            'українська',
            $language->getLocalName()
        );

        $this->assertSame(
            'ukr',
            $language->getAlpha3()
        );

        $this->assertSame(
            'I',
            $language->getScope()
        );

        $this->assertSame(
            'L',
            $language->getType()
        );

        $this->assertSame(
            null,
            $language->getInvertedName()
        );

        $this->assertSame(
            'uk',
            $language->getAlpha2()
        );
    }

    /**
     * @dataProvider languageDatabaseProvider
     */
    public function testGetByAlpha3(AbstractDatabase $languageDatabase): void
    {
        $language = $languageDatabase->getByAlpha3('ukr');
        
        $this->assertEquals(
            'Ukrainian',
            $language->getName()
        );

        $this->assertEquals(
            'українська',
            $language->getLocalName()
        );
    }
}
