<?php

namespace Elephant418\Model418\Core;

class Factory
{
    
    /* ATTRIBUTES
     *************************************************************************/
    public static $indexList = array();
    

    /* PUBLIC METHODS
     *************************************************************************/
    public function get($index)
    {
        $id = strtolower($index);
        if (!isset(static::$indexList[$id])) {
            throw new \RuntimeException('No FileRequest found for: '.$id);
        }
        $class = static::$indexList[$id];
        return new $class;
    }
    
    public function register($class, $indexList)
    {
        if (!is_array($indexList)) {
            $indexList = array($indexList);
        }
        foreach ($indexList as $index) {
            $id = strtolower($index);
            static::$indexList[$id] = $class;
        }
        return $this;
    }
}