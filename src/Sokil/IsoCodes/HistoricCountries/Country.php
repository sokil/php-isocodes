<?php

namespace Sokil\IsoCodes\HistoricCountries;

class Country extends \Sokil\IsoCodes\Database\Entry
{
    public $name;
    
    public $code;
    
    public function getCode()
    {
        return $this->code;
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