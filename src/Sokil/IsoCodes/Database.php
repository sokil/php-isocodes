<?php

namespace Sokil\IsoCodes;

abstract class Database
{
    const DATABASE_PATH = '/../../../databases';
    
    protected $_iso;
    
    protected $_index = array();
    
    protected $_values = array();
    
    protected $_localValues = array();
    
    protected $_entryTagName;
    
    protected $_valueAttributeName;
    
    public function __construct()
    {
        $this->_load(__DIR__ . self::DATABASE_PATH . '/' . $this->_iso . '.xml');
    }
    
    private function _load($xmlFile)
    {
        $xml = new \DOMDocument();
        $xml->load($xmlFile);
        
        $list = $xml->getElementsByTagName($this->_entryTagName);
        
        /* @var $entry \DOMElement */
        foreach($list as $entry) {
            
            $value = $entry->getAttribute($this->_valueAttributeName);
            $this->_values[] = $value;
            $this->_localValues[] = dgettext($this->_iso, $value);
            
            /* @var $entry \DOMAttr */
            foreach($entry->attributes as $attribute) {
                if($attribute->name == $this->_valueAttributeName) {
                    continue;
                }
                
                $this->_index[$attribute->name][$attribute->value] = $value;
            }
        }
        
    }
    
    public function getAll()
    {
        return $this->_values;
    }
    
    public function getAllLocal()
    {
        return $this->_localValues;
    }
}

