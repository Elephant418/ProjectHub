<?php

namespace ProjectHub;

class Model extends \ArrayObject
{


    /* ATTRIBUTES
     *************************************************************************/
    public $id;
    public $schema = array();


    /* INITIALIZATION
     *************************************************************************/
    public function initByData($data)
    {
        if (!isset($data['id'])) {
            return null;
        }
        $this->id = $data['id'];
        foreach ($this->schema as $attributeName => $attributeValue) {
            if (isset($data[$attributeName])) {
                $attributeValue = $data[$attributeName];
            }
            $this->offsetSet($attributeName, $attributeValue);
        }
        $this->initialization();
        return $this;
    }

    protected function initialization()
    {

    }


    /* GETTER & SETTER
     *************************************************************************/
    public function __get($name)
    {
        return $this->offsetGet($name);
    }
    
    public function __set($name, $value)
    {
        return $this->offsetSet($name, $value);
    }

    public function offsetSet($name, $value)
    {
        if (isset($this->schema[$name])) {
            parent::offsetSet($name, $value);
        }
        return $this;
    }
}