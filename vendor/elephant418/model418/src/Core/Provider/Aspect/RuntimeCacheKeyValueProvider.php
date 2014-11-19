<?php

namespace Elephant418\Model418\Core\Provider\Aspect;

abstract class RuntimeCacheKeyValueProvider extends KeyValueProvider
{


    /* ATTRIBUTES
     *************************************************************************/
    protected $_cache = array();


    /* FETCHING METHODS
     *************************************************************************/
    public function fetchById($id)
    {
        if ($this->hasCache()) {
            $data = $this->getCacheItem($id);
            return $data;
        }
        return parent::fetchById($id);
    }
    
    public function fetchAll($limit = null, $offset = null, &$count = false)
    {
        if ($this->hasCache()) {
            $dataList = $this->getCache();
            return $this->slice($dataList, $limit, $offset);
        }
        $dataList = parent::fetchAll($limit, $offset, $count);
        if (is_null($limit)) {
            $this->setCache($dataList);
        }
        return $dataList;
    }


    /* SAVE METHODS
     *************************************************************************/
    public function saveById($id, $data)
    {
        $id = parent::saveById($id, $data);
        $this->setCacheItem($id, $data);
        return $id;
    }

    public function deleteById($id)
    {
        $status = parent::deleteById($id);
        $this->clearCacheItem($id);
        return $status;
    }


    /* CACHE METHODS
     *************************************************************************/
    public function clearCache()
    {
        $this->_cache[get_called_class()] = null;
        return $this;
    }
    
    public function clearCacheItem($id)
    {
        if ($this->hasCache()) {
            $this->_cache[get_called_class()][$id] = null;
        }
        return $this;
    }
    
    protected function setCache($dataList)
    {
        $this->_cache[get_called_class()] = $dataList;
        return $this;
    }

    protected function setCacheItem($id, $data)
    {
        if ($this->hasCache()) {
            $data['id'] = $id;
            $this->_cache[get_called_class()][$id] = $data;
        }
        return $this;
    }

    protected function hasCache()
    {
        return isset($this->_cache[get_called_class()]);
    }

    protected function getCache()
    {
        if ($this->hasCache()) {
            return $this->_cache[get_called_class()];
        }
        return array();
    }

    protected function getCacheItem($id)
    {
        if (!$this->hasCache()) {
            return array();
        }
        if (!isset($this->_cache[get_called_class()][$id])) {
            return array();
        }
        return $this->_cache[get_called_class()][$id];
    }
}