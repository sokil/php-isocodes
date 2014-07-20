<?php

namespace Sokil\IsoCodes;

class HistoricCurrencies extends Database
{
    protected $_iso = 'iso4217';
    
    protected $_entryTagName = 'historic_iso_4217_entry';
    
    protected $_entryClassName = '\Sokil\IsoCodes\HistoricCurrencies\Currency';
    
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