<?php

namespace ProjectHub;

class Entity
{


    /* ATTRIBUTES
     *************************************************************************/
    protected $modelClass;
    protected $dataFolder;


    /* CONSTRUCTOR
     *************************************************************************/
    public function __construct()
    {
        $this->dataFolder = ROOT_PATH . $this->dataFolder;
    }


    /* FETCHING METHODS
     *************************************************************************/
    public function fetchById($id)
    {
        $sourceFile = $this->getSourceFileById($id);
        if (!file_exists($sourceFile)) {
            return null;
        }
        $data = $this->getDataFromSourceFile($id, $sourceFile);
        return $this->resultAsModel($data);
    }

    public function fetchByIdList($idList)
    {
        $modelList = [];
        foreach ($idList as $id) {
            $model = $this->fetchById($id);
            if ($model) {
                $modelList[$id] = $model;
            }
        }
        return $modelList;
    }

    public function fetchAll($limit = null, $offset = null, &$count = false)
    {
        $idList = $this->getAllIds();
        if ($count !== false) {
            $count = count($idList);
        }
        if (is_null($offset)) {
            $offset = 0;
        }
        if (! is_null($limit)) {
            $idList = array_slice($idList, $offset, $offset + $limit);
        }
        return $this->fetchByIdList($idList);
    }


    /* PRIVATE MODEL METHODS
     *************************************************************************/
    protected function getModel()
    {
        return new $this->modelClass;
    }

    protected function resultAsModelList($dataList)
    {
        $modelList = [];
        foreach ($dataList as $data) {
            $model = $this->getModel();
            $modelList[] = $model->initByData($data);
        }
        return $modelList;
    }

    protected function resultAsModel($data)
    {
        return $this->getModel()->initByData($data);
    }


    /* PROTECTED SOURCE FILE METHODS
     *************************************************************************/
    protected function getDataFromSourceFile($id, $filePath)
    {
        $data = [];
        $data['id'] = $id;
        $jsonData = json_decode(file_get_contents($filePath), true);
        if (is_array($jsonData)) {
            $data = array_merge($data, $jsonData);
        }
        return $data;
    }

    protected function getSourceFileById($id)
    {
        return $this->dataFolder.'/'.$id.'.json';
    }

    protected function getAllIds()
    {
        $idList = [];
        foreach (glob($this->dataFolder.'/*.json') as $file) {
            $file = basename($file);
            $id = substr($file, 0, strrpos($file, '.'));
            $idList[] = $id;
        }
        return $idList;
    }


}