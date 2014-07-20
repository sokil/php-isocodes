<?php

namespace Sokil\IsoCodes;

class Subdivisions extends Database
{
    protected $_iso = 'iso3166_2';
    
    protected $_entryTagName = 'iso_3166_country';
    
    protected $_entryClassName = '\Sokil\IsoCodes\Subdivisions\Subdivision';
    
    public function getByAlpha2($code)
    {
        $code = strtoupper($code);
        
        return isset($this->_index['code'][$code])
            ? $this->_index['code'][$code]
            : null;
    }
}