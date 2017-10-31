<?php

namespace Sokil\IsoCodes\Database;

use Sokil\IsoCodes\AbstractDatabase;

class HistoricCountries extends AbstractDatabase
{
    protected $ISONumber = 'iso_3166-3';
    
    protected $_entryTagName = '3166_3';
    
    protected $entryClassName = '\Sokil\IsoCodes\Database\HistoricCountries\Country';
    
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
