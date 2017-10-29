<?php

namespace Sokil\IsoCodes\Database\Currencies;

use Sokil\IsoCodes\AbstractDatabaseEntry;

class Currency extends AbstractDatabaseEntry
{
    public $letter_code;
    
    public $numeric_code;
    
    public $currency_name;
    
    public function getLetterCode()
    {
        return $this->letter_code;
    }
    
    public function getNumericCode()
    {
        return $this->numeric_code;
    }
    
    public function getName()
    {
        return $this->currency_name;
    }
    
    public function getLocalName()
    {
        return dgettext($this->_database->getIso(), $this->currency_name);
    }
}
