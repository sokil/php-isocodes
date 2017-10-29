<?php

namespace Sokil\IsoCodes\Database\Subdivisions;

use Sokil\IsoCodes\AbstractDatabaseEntry;

class Subdivision extends AbstractDatabaseEntry
{
    private $_alpha2;
    
    private $_subDivisionName;
    
    private $_list = array();
    
    public function getAlpha2()
    {
        return $this->_alpha2;
    }
    
    public function getSubDivisionName()
    {
        return $this->_subDivisionName;
    }
    
    public function applyXMLElement(\DOMElement $element)
    {
        $this->_alpha2 = $element->getAttribute('code');
        
        $listXMLNode = $element->getElementsByTagName('iso_3166_subset');
        
        // check if country has sub divisions
        if(!$listXMLNode->length) {
            return;
        }
        
        // get sub division type
        $this->_subDivisionName = $listXMLNode
            ->item(0)
            ->getAttribute('type');
            
        foreach($element->getElementsByTagName('iso_3166_2_entry') as $element) {
            $this->_list[$element->getAttribute('code')] = $element->getAttribute('name');
        }
    }
    
    public function getList()
    {
        return $this->_list;
    }
    
    public function getLocalList()
    {
        $self = $this;
        
        return array_map(function($name) use($self) {
            return dgettext($self->getDatabase()->getIso(), $name);
        }, $this->_list);
    }
}
