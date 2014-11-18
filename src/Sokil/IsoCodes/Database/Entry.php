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
    
    /**
     * Get data from XML and place to object
     * 
     * @param \DOMAttr $element
     * @param \Sokil\IsoCodes\Database\Entry $entry
     */
    public function applyXMLElement(\DOMElement $element)
    {
        /* @var $entry \DOMAttr */
        foreach($element->attributes as $attribute) {
            $this->{$attribute->name} = $attribute->value;
        }
    }
    
    /**
     * !INTERNAL
     * 
     * Used to get database from closure due to combatibility with 5.3
     * where access of protected properties now allowed
     * @return \Sokil\IsoCode\Database Database instance
     */
    public function getDatabase()
    {
        return $this->_database;
    }
}