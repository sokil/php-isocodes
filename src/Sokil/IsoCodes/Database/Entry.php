<?php

namespace Sokil\IsoCodes\Database;

class Entry
{
    /**
     *
     * @var \Sokil\IsoCode\Database
     */
    protected $_database;
    
    public function __construct(\Sokil\IsoCodes\Database $database)
    {
        $this->_database = $database;
    }
}