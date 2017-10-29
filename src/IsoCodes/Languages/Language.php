<?php

namespace Sokil\IsoCodes\Languages;

class Language extends \Sokil\IsoCodes\AbstractDatabaseEntry
{
    public $name;
    
    public $alpha_2_code;
    
    public $alpha_3_code;
    
    public function getAlpha2()
    {
        return $this->iso_639_1_code;
    }
    
    public function getAlpha3()
    {
        return $this->iso_639_2B_code;
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
