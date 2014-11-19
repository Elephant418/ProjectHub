<?php

namespace Elephant418\Model418\Core;

abstract class Factory
{
    
    /* ATTRIBUTES
     *************************************************************************/
    public static $indexList = array();
    

    /* PUBLIC METHODS
     *************************************************************************/
    public function newInstance($index)
    {
        $id = strtolower($index);
        if (!isset(static::$indexList[get_called_class()][$id])) {
            throw new \RuntimeException('No FileRequest found for: '.$id);
        }
        $class = static::$indexList[get_called_class()][$id];
        return new $class;
    }
    
    public function register($class, $indexList)
    {
        if (is_object($class)) {
            $class = get_class($class);
        }
        if (!is_array($indexList)) {
            $indexList = array($indexList);
        }
        if (!isset(static::$indexList[get_called_class()])) {
            static::$indexList[get_called_class()] = array();
        }
        foreach ($indexList as $index) {
            $id = strtolower($index);
            static::$indexList[get_called_class()][$id] = $class;
        }
        return $this;
    }
}