<?php

namespace Sokil\IsoCodes;

use Sokil\IsoCodes\Database\Countries;
use Sokil\IsoCodes\Database\Currencies;
use Sokil\IsoCodes\Database\HistoricCountries;
use Sokil\IsoCodes\Database\HistoricCurrencies;
use Sokil\IsoCodes\Database\Languages;
use Sokil\IsoCodes\Database\Scripts;
use Sokil\IsoCodes\Database\Subdivisions;

class IsoCodesFactory
{
    const LOCALES_PATH = '/../locales';

    /**
     * @var bool
     */
    private static $isGettextBoung = false;

    /**
     * Bind gettext to locales dir
     */
    public function __construct()
    {
        if (!self::$isGettextBoung) {
            self::$isGettextBoung = true;

            $isoDatabases = array(
                'iso3166',
                'iso3166_2',
                'iso639',
                'iso4217',
                'iso15924'
            );

            foreach ($isoDatabases as $isoDatabase) {
                bindtextdomain($isoDatabase, __DIR__ . self::LOCALES_PATH);
                bind_textdomain_codeset($isoDatabase, 'UTF-8');
            }
        }
    }
    
    /**
     * 
     * @return Countries
     */
    public function getCountries()
    {
        return new Countries();
    }
    
    /**
     * 
     * @return HistoricCountries
     */
    public function getHistoricCountries()
    {
        return new HistoricCountries();
    }
    
    /**
     * 
     * @return Scripts
     */
    public function getScripts()
    {
        return new Scripts();
    }
    
    /**
     * 
     * @return Countries
     */
    public function getCurrencies()
    {
        return new Currencies();
    }
    
    /**
     * 
     * @return HistoricCountries
     */
    public function getHistoricCurrencies()
    {
        return new HistoricCurrencies();
    }
    
    /**
     * 
     * @return Languages
     */
    public function getLanguages()
    {
        return new Languages();
    }
    
    /**
     * 
     * @return Subdivisions
     */
    public function getSubdivisions()
    {
        return new Subdivisions();
    }
    
}
