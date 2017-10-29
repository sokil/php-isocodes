<?php

namespace Sokil\IsoCodes;

class Currencies extends Database
{
    protected $_iso = 'iso4217';
    
    protected $_entryTagName = 'iso_4217_entry';
    
    protected $_entryClassName = '\Sokil\IsoCodes\Currencies\Currency';
    
    public function getByLetterCode($code)
    {
        $code = strtoupper($code);
        
        return isset($this->_index['letter_code'][$code])
            ? $this->_index['letter_code'][$code]
            : null;
    }
    
    public function getByNumericCode($code)
    {
        return isset($this->_index['numeric_code'][$code])
            ? $this->_index['numeric_code'][$code]
            : null;
    }
}