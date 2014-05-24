<?php

namespace Sokil;

class IsoCodes
{
    const DATABASE_PATH = '/../../databases';
    
    /**
     * 
     * @return \Sokil\IsoCodes\Countries
     */
    public function getCountries()
    {
        return new IsoCodes\Countries(__DIR__ . self::DATABASE_PATH . '/iso3166.xml');
    }
    
    public function getHistoricCountries()
    {
        return new IsoCodes\HistoricCountries(__DIR__ . self::DATABASE_PATH . '/iso3166.xml');
    }
    
    public function getScripts()
    {
        return new IsoCodes\Scripts(__DIR__ . self::DATABASE_PATH . '/iso15924.xml');
    }
    
    public function getCurrencies()
    {
        return new IsoCodes\Countries(__DIR__ . self::DATABASE_PATH . '/iso4217.xml');
    }
    
    public function getLanguages()
    {
        return new IsoCodes\Languages(__DIR__ . self::DATABASE_PATH . '/iso639.xml');
    }
    
    public function getSubdivisions()
    {
        return new IsoCodes\Subdivisions(__DIR__ . self::DATABASE_PATH . '/iso3166_2.xml');
    }
    
}
