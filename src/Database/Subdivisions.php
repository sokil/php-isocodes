<?php

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractDatabase;

class Subdivisions extends AbstractDatabase
{
    protected $_iso = 'iso3166_2';
    
    protected $_entryTagName = 'iso_3166_country';
    
    protected $_entryClassName = '\Sokil\IsoCodes\Database\Subdivisions\Subdivision';
    
    public function getByAlpha2($code)
    {
        $code = strtoupper($code);
        
        return isset($this->_index['code'][$code])
            ? $this->_index['code'][$code]
            : null;
    }
}
