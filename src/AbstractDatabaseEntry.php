<?php

namespace Sokil\IsoCodes;

use \Sokil\IsoCodes\AbstractDatabase;

/**
 * Abstract ISO database
 */
class AbstractDatabaseEntry
{
    /**
     *
     * @var \Sokil\IsoCode\Database
     */
    protected $_database;

    /**
     * AbstractDatabaseEntry constructor.
     * @param \Sokil\IsoCodes\AbstractDatabase $database
     */
    public function __construct(AbstractDatabase $database)
    {
        $this->_database = $database;
    }
    
    /**
     * Get data from XML and place to object
     * 
     * @param \DOMAttr $element
     * @param \Sokil\IsoCodes\Database\AbstractDatabaseEntry $entry
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
     * @return AbstractDatabase AbstractDatabase instance
     */
    public function getDatabase()
    {
        return $this->_database;
    }
}
