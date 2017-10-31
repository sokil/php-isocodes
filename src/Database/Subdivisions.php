<?php

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractDatabase;

class Subdivisions extends AbstractDatabase
{
    protected $ISONumber = 'iso_3166-2';
    
    protected $_entryTagName = '3166-2';
    
    protected $entryClassName = '\Sokil\IsoCodes\Database\Subdivisions\Subdivision';
    
    public function getByAlpha2($code)
    {
        $code = strtoupper($code);
        
        return isset($this->_index['code'][$code])
            ? $this->_index['code'][$code]
            : null;
    }
}
