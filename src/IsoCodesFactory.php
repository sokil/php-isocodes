<?php

namespace Sokil\IsoCodes;

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
     * @return \Sokil\IsoCodes\Countries
     */
    public function getCountries()
    {
        return new IsoCodes\Countries;
    }
    
    /**
     * 
     * @return \Sokil\IsoCodes\HistoricCountries
     */
    public function getHistoricCountries()
    {
        return new IsoCodes\HistoricCountries;
    }
    
    /**
     * 
     * @return \Sokil\IsoCodes\Scripts
     */
    public function getScripts()
    {
        return new IsoCodes\Scripts;
    }
    
    /**
     * 
     * @return \Sokil\IsoCodes\Countries
     */
    public function getCurrencies()
    {
        return new IsoCodes\Currencies;
    }
    
    /**
     * 
     * @return \Sokil\IsoCodes\Countries
     */
    public function getHistoricCurrencies()
    {
        return new IsoCodes\HistoricCurrencies;
    }
    
    /**
     * 
     * @return \Sokil\IsoCodes\Languages
     */
    public function getLanguages()
    {
        return new IsoCodes\Languages;
    }
    
    /**
     * 
     * @return \Sokil\IsoCodes\Subdivisions
     */
    public function getSubdivisions()
    {
        return new IsoCodes\Subdivisions;
    }
    
}
