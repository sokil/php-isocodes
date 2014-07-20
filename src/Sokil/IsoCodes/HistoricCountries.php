<?php

namespace Sokil\IsoCodes;

class HistoricCountries extends Database
{
    protected $_iso = 'iso3166_2';
    
    protected $_entryTagName = 'iso_3166_2_entry';
    
    protected $_entryClassName = '\Sokil\IsoCodes\HistoricCountries\Country';
    
    public function getByCode($code)
    {
        $code = strtoupper($code);
        
        return isset($this->_index['code'][$code])
            ? $this->_index['code'][$code]
            : null;
    }
}