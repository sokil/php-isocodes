<?php

namespace Sokil\IsoCodes;

class Countries extends Database
{
    protected $_iso = 'iso3166';
    
    protected $_entryTagName = 'iso_3166_entry';
    
    protected $_entryClassName = '\Sokil\IsoCodes\Countries\Country';
    
    public function getByAlpha2($alpha2)
    {
        return isset($this->_index['alpha_2_code'][$alpha2])
            ? $this->_index['alpha_2_code'][$alpha2]
            : null;
    }
    
    public function getByAlpha3($alpha3)
    {
        return isset($this->_index['alpha_3_code'][$alpha3])
            ? $this->_index['alpha_3_code'][$alpha3]
            : null;
    }
    
    public function getByNumericCode($code)
    {
        return isset($this->_index['numeric_code'][$code])
            ? $this->_index['numeric_code'][$code]
            : null;
    }
}