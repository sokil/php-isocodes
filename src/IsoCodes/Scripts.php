<?php

namespace Sokil\IsoCodes;

class Scripts extends AbstractDatabase
{
    protected $_iso = 'iso15924';
    
    protected $_entryTagName = 'iso_15924_entry';
    
    protected $_entryClassName = '\Sokil\IsoCodes\Scripts\Script';
    
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
