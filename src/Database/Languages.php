<?php

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractDatabase;

class Languages extends AbstractDatabase
{
    protected $ISONumber = 'iso_639-3';
    
    protected $_entryTagName = '639-3';
    
    protected $entryClassName = '\Sokil\IsoCodes\Database\Languages\Language';
    
    public function getByAlpha2($alpha2)
    {
        $alpha2 = strtolower($alpha2);
        
        return isset($this->_index['iso_639_1_code'][$alpha2])
            ? $this->_index['iso_639_1_code'][$alpha2]
            : null;
    }
    
    public function getByAlpha3($alpha3)
    {
        $alpha3 = strtolower($alpha3);
        
        return isset($this->_index['iso_639_2B_code'][$alpha3])
            ? $this->_index['iso_639_2B_code'][$alpha3]
            : null;
    }
}
