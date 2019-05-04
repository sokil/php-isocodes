<?php
declare(strict_types=1);

namespace Sokil\IsoCodes\Databases;

use Sokil\IsoCodes\Database\Currencies\Currency;
use Sokil\IsoCodes\IsoCodesFactory;
use PHPUnit\Framework\TestCase;

class CurrenciesTest extends TestCase
{

    public function testIterator(): void
    {
        $isoCodes = new IsoCodesFactory();
        $currencies = $isoCodes->getCurrencies();
        foreach ($currencies as $currency) {
            $this->assertInstanceOf(
                Currency::class,
                $currency
            );
        }
    }
    
    public function testGetByLetterCode(): void
    {
        $isoCodes = new IsoCodesFactory();

        $currencies = $isoCodes->getCurrencies();
        $currency = $currencies->getByLetterCode('CZK');

        $this->assertInstanceOf(
            Currency::class,
            $currency
        );

        $this->assertEquals(
            'Czech Koruna',
            $currency->getName()
        );

        $this->assertEquals(
            'Чеська крона',
            $currency->getLocalName()
        );

        $this->assertSame(
            'CZK',
            $currency->getLetterCode()
        );

        $this->assertSame(
            203,
            $currency->getNumericCode()
        );
    }
        
    public function testGetByNumericCode(): void
    {
        $isoCodes = new IsoCodesFactory();

        $currencies = $isoCodes->getCurrencies();
        $currency = $currencies->getByNumericCode(203);

        $this->assertEquals(
            'Czech Koruna',
            $currency->getName()
        );

        $this->assertEquals(
            'Чеська крона',
            $currency->getLocalName()
        );
    }
}
