<?php

namespace Elephant418\Model418\Core\Model;

use Elephant418\Model418\Core\ArrayObject;

class StoredModel extends SchemaModel
{


    /* ATTRIBUTES
     *************************************************************************/
    public $id;
    protected static $_query = array();


    /* GETTER & SETTER
     *************************************************************************/
    public function exists()
    {
        return !is_null($this->id);
    }

    public function name()
    {
        return $this->id;
    }

    public function duplicate()
    {
        $this->id = null;
        return $this;
    }


    /* INITIALIZATION
     *************************************************************************/
    public function __construct($query = null)
    {
        parent::__construct();
        $this->injectQuery($query);
    }

    public function initByData($data)
    {
        if (!isset($data['id'])) {
            throw new \Exception('Try to retrieve incomplete data');
        }
        $this->id = $data['id'];
        unset($data['id']);
        parent::initByData($data);
        return $this;
    }


    /* PUBLIC STORING METHODS
     *************************************************************************/
    public function save()
    {
        $id = $this->getQuery()->saveById($this->id, $this->toArray());
        if (is_null($this->id)) {
            $this->id = $id;
        }
        return $this;
    }

    public function delete()
    {
        if (!is_null($this->id)) {
            $this->getQuery()->deleteById($this->id);
        }
        return $this;
    }

    public function query()
    {
        return $this->getQuery();
    }


    /* ENTITY METHODS
     *************************************************************************/
    protected function initQuery()
    {
        throw new \LogicException('This method must be overridden');
    }
    
    protected function injectQuery($query) {
        if (!$this->hasQuery() && !$query) {
            $query = $this->initQuery();
        }
        if ($query) {
            $this->setQuery($query);
        }
    }

    protected function hasQuery()
    {
        return isset(static::$_query[get_called_class()]);
    }

    protected function setQuery($query)
    {
        static::$_query[get_called_class()] = $query;
        return $this;
    }

    protected function getQuery()
    {
        if (!$this->hasQuery()) {
            return null;
        }
        return static::$_query[get_called_class()];
    }
}