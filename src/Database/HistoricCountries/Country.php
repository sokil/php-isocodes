<?php

namespace Sokil\IsoCodes\Database\HistoricCountries;

use Sokil\IsoCodes\AbstractDatabaseEntry;

class Country extends AbstractDatabaseEntry
{
    public $names;
    
    public $alpha_4_code;
    
    public $alpha_3_code;
    
    public $numeric_code;
    
    public function getAlpha4()
    {
        return $this->alpha_4_code;
    }
    
    public function getAlpha3()
    {
        return $this->alpha_3_code;
    }
    
    public function getNames()
    {
        return $this->names;
    }
    
    public function getLocalNames()
    {
        return dgettext($this->_database->getISONumber(), $this->names);
    }
}
