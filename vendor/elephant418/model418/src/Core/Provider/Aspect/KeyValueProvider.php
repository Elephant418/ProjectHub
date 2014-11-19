<?php

namespace Elephant418\Model418\Core\Provider\Aspect;

abstract class KeyValueProvider
{


    /* ATTRIBUTES
     *************************************************************************/
    protected $key;
    protected $request;


    /* KEY METHODS
     *************************************************************************/
    public function getKey()
    {
        return $this->key;
    }

    public function setKey($key)
    {
        $this->key = $key;
        return $this;
    }


    /* FILE REQUEST METHODS
     *************************************************************************/
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    public function getRequest()
    {
        if (!$this->request) {
            $this->setRequest($this->initDefaultRequest());
        }
        return $this->request;
    }
    
    
    /* FETCHING METHODS
     *************************************************************************/
    public function fetchById($id)
    {
        $data = $this->getRequest()->getContents($this->getKey(), $id);
        return $data;
    }

    public function fetchByIdList($idList)
    {
        $dataList = array();
        foreach ($idList as $id) {
            $data = $this->fetchById($id);
            if ($data) {
                $dataList[$id] = $data;
            }
        }
        return $dataList;
    }

    public function fetchAll($limit = null, $offset = null, &$count = false)
    {
        $idList = $this->getAllIds();
        if ($count !== false) {
            $count = count($idList);
        }
        $idList = $this->slice($idList, $limit, $offset);
        $dataList = $this->fetchByIdList($idList);
        return $dataList;
    }


    /* SAVE METHODS
     *************************************************************************/
    public function saveById($id, $data)
    {
        $this->getRequest()->putContents($this->getKey(), $id, $data);
        return $id;
    }

    public function deleteById($id)
    {
        $status = $this->getRequest()->unlink($this->getKey(), $id);
        return $status;
    }


    /* PROTECTED METHODS
     *************************************************************************/
    protected function initDefaultRequest()
    {
        throw new \LogicException('This method must be overridden');
    }


    /* PROTECTED METHODS
     *************************************************************************/
    protected function isIdAvailable($id)
    {
        return !$this->getRequest()->exists($this->getKey(), $id);
    }

    protected function getAllIds()
    {
        $idList = $this->getRequest()->getIdList($this->getKey());
        return $idList;
    }
    
    protected function slice($dataList, $limit = null, $offset = null)
    {
        if (is_null($offset)) {
            $offset = 0;
        }
        if (!is_null($limit)) {
            $dataList = array_slice($dataList, $offset, $limit);
        }
        return $dataList;
    }
}