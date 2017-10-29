<?php

namespace Sokil;

class IsoCodes
{
    const LOCALES_PATH = '/../locales';

    static $_gettextBinded = false;
    
    public function __construct()
    {
        if(!self::$_gettextBinded) {
            self::$_gettextBinded = true;
            
            bindtextdomain('iso3166', __DIR__ . self::LOCALES_PATH);
            bind_textdomain_codeset('iso3166', 'UTF-8');
            
            bindtextdomain('iso3166_2', __DIR__ . self::LOCALES_PATH);
            bind_textdomain_codeset('iso3166_2', 'UTF-8');
            
            bindtextdomain('iso639', __DIR__ . self::LOCALES_PATH);
            bind_textdomain_codeset('iso639', 'UTF-8');
            
            bindtextdomain('iso4217', __DIR__ . self::LOCALES_PATH);
            bind_textdomain_codeset('iso4217', 'UTF-8');
            
            bindtextdomain('iso15924', __DIR__ . self::LOCALES_PATH);
            bind_textdomain_codeset('iso15924', 'UTF-8');
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
