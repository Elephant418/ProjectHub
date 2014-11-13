<?php

namespace Model418\Core;

class ListObject extends \ArrayObject
{


    /* CONSTRUCTOR
     *************************************************************************/
    public function __construct($input = [])
    {
        $this->exchangeArray(array_values($input));
    }


    /* GETTER & SETTER
     *************************************************************************/
    public function offsetGet($name)
    {
        if (!$this->offsetExists($name)) {
            return null;
        }
        return parent::offsetGet($name);
    }
    
    public function offsetSet($index, $value)
    {
        if (!is_int($index)) {
            throw new \Exception('Index type not supported: ' . $index);
        }
        if ($index > $this->count() + 1) {
            throw new \Exception('Index value not supported: ' . $index);
        }
        return $this->offsetSet($index, $value);
    }

    public function add($value)
    {
        $this->append($value);
        return $this;
    }

    public function toArray()
    {
        return $this->getArrayCopy();
    }
}