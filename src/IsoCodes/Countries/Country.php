<?php

namespace Sokil\IsoCodes\Countries;

class Country extends \Sokil\IsoCodes\AbstractDatabaseEntry
{
    public $name;
    
    public $alpha_2_code;
    
    public $alpha_3_code;
    
    public $numeric_code;
    
    public $official_name;
    
    public function getAlpha2()
    {
        return $this->alpha_2_code;
    }
    
    public function getAlpha3()
    {
        return $this->alpha_2_code;
    }
    
    public function getNumericCode()
    {
        return $this->numeric_code;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getLocalName()
    {
        return dgettext($this->_database->getIso(), $this->name);
    }
}
