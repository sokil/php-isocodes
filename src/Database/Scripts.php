<?php

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractDatabase;

class Scripts extends AbstractDatabase
{
    protected $ISONumber = 'iso_15924';
    
    protected $_entryTagName = '15924';
    
    protected $entryClassName = '\Sokil\IsoCodes\Database\Scripts\Script';
    
    public function getByAlpha4($alpha4)
    {
        $alpha4 = ucfirst(strtolower($alpha4));
        
        return isset($this->_index['alpha_4_code'][$alpha4])
            ? $this->_index['alpha_4_code'][$alpha4]
            : null;
    }
    
    public function getByNumericCode($code)
    {        
        return isset($this->_index['numeric_code'][$code])
            ? $this->_index['numeric_code'][$code]
            : null;
    }
}
