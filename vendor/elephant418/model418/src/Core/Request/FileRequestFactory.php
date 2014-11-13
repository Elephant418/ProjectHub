<?php

namespace Model418\Core\Request;

class FileRequestFactory
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
    
    public function register($class)
    {
        foreach ($class::$factoryIndexList as $index) {
            $id = strtolower($index);
            static::$indexList[$id] = $class;
        }
        return $this;
    }
}