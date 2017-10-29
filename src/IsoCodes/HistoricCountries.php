<?php

namespace Sokil\IsoCodes;

class HistoricCountries extends AbstractDatabase
{
    protected $_iso = 'iso3166';
    
    protected $_entryTagName = 'iso_3166_3_entry';
    
    protected $_entryClassName = '\Sokil\IsoCodes\HistoricCountries\Country';
    
    public function getByAlpha4($code)
    {
        $code = strtoupper($code);
        
        return isset($this->_index['alpha_4_code'][$code])
            ? $this->_index['alpha_4_code'][$code]
            : null;
    }
    
    public function getByAlpha3($code)
    {
        $code = strtoupper($code);
        
        return isset($this->_index['alpha_3_code'][$code])
            ? $this->_index['alpha_3_code'][$code]
            : null;
    }
    
    public function getByNumericCode($code)
    {
        return isset($this->_index['numeric_code'][$code])
            ? $this->_index['numeric_code'][$code]
            : null;
    }
}
