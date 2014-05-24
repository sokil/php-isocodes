<?php

namespace Sokil\IsoCodes;

abstract class Database
{
    private $_xmlFile;
    
    protected $_index = array();
    
    protected $_values = array();
    
    protected $_entryTagName;
    
    protected $_valueAttributeName;
    
    public function __construct($xmlFile)
    {
        $this->_xmlFile = $xmlFile;
        $this->_load();
    }
    
    private function _load()
    {
        $xml = new \DOMDocument();
        $xml->load($this->_xmlFile);
        
        $list = $xml->getElementsByTagName($this->_entryTagName);
        
        /* @var $entry \DOMElement */
        foreach($list as $entry) {
            
            $value = $entry->getAttribute($this->_valueAttributeName);
            $this->_values[] = $value;
            
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
}

