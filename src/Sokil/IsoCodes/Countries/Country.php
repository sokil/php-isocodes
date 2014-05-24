<?php

namespace Sokil\IsoCodes\Countries;

class Country extends \Sokil\IsoCodes\Database\Entry
{
    public $name;
    
    public $alpha_2_code;
    
    public $alpha_3_code;
    
    public $numeric_code;
    
    public $official_name;
    
    public function getLocalName()
    {
        return dgettext($this->_database->getIso(), $this->name);
    }
}