<?php

namespace Elephant418\Model418\Core\Request;

class SessionRequest implements INoRelationRequest
{
    
    /* CONSTANTS
     *************************************************************************/
    const SCOPE_KEY = 'Elephant418\Model418:storage';
    

    /* PUBLIC METHODS
     *************************************************************************/
    public function getContents($key, $id)
    {
        if (!$this->exists($key, $id)) {
            return null;
        }
        $data = $_SESSION[self::SCOPE_KEY][$key][$id];
        if (is_array($data)) {
            $data['id'] = $id;
        }
        return $data;
    }

    public function putContents($key, $id, $data)
    {
        $this->initKey($key);
        $_SESSION[self::SCOPE_KEY][$key][$id] = $data;
    }
    
    public function exists($key, $id)
    {
        $this->initKey($key);
        return isset($_SESSION[self::SCOPE_KEY][$key][$id]);
    }

    public function unlink($key, $id)
    {
        unset($_SESSION[self::SCOPE_KEY][$key][$id]);
    }

    public function getIdList($key)
    {
        $this->initKey($key);
        $idList = array_keys($_SESSION[self::SCOPE_KEY][$key]);
        return $idList;
    }


    /* PUBLIC METHODS
     *************************************************************************/
    public function initKey($key)
    {
        if (!isset($_SESSION[self::SCOPE_KEY])) {
            $_SESSION[self::SCOPE_KEY] = array();
        }
        if (!isset($_SESSION[self::SCOPE_KEY][$key])) {
            $_SESSION[self::SCOPE_KEY][$key] = array();
        }
    }
}