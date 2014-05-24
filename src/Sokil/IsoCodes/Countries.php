<?php

namespace Sokil\IsoCodes;

class Countries extends Database
{
    protected $_iso = 'iso3166';
    
    protected $_entryTagName = 'iso_3166_entry';
    
    protected $_valueAttributeName = 'name';
    
    public function getByAlpha2($alpha2)
    {
        return isset($this->_index['alpha_2_code'][$alpha2])
            ? $this->_index['alpha_2_code'][$alpha2]
            : null;
    }
    
    public function getLocalByAlpha2($alpha2)
    {
        return isset($this->_index['alpha_2_code'][$alpha2])
            ? dgettext('iso3166', $this->_index['alpha_2_code'][$alpha2])
            : null;
    }
    
    public function getByAlpha3($alpha3)
    {
        return isset($this->_index['alpha_3_code'][$alpha3])
            ? $this->_index['alpha_3_code'][$alpha3]
            : null;
    }
    
    public function getLocalByAlpha3($alpha3)
    {
        return isset($this->_index['alpha_3_code'][$alpha3])
            ? dgettext('iso3166', $this->_index['alpha_3_code'][$alpha3])
            : null;
    }
    
    public function getByNumericCode($code)
    {
        return isset($this->_index['numeric_code'][$code])
            ? $this->_index['numeric_code'][$code]
            : null;
    }
    
    public function getLocalByNumericCode($code)
    {
        return isset($this->_index['numeric_code'][$code])
            ? dgettext('iso3166', $this->_index['numeric_code'][$code])
            : null;
    }
}