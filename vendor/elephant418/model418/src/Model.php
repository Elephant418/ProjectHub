<?php

namespace Model418;

use Model418\Core\ArrayObject;
use Model418\Core\IModel;

class Model extends ArrayObject implements IModel
{


    /* ATTRIBUTES
     *************************************************************************/
    public $id;
    protected static $_schema = array();
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

    public function offsetSet($name, $value)
    {
        if ($this->hasSchema($name)) {
            parent::offsetSet($name, $value);
        }
        return $this;
    }


    /* INITIALIZATION
     *************************************************************************/
    public function __construct($query = null)
    {
        parent::__construct();
        $this->injectQuery($query);
        if (!$this->hasSchema()) {
            $schema = $this->initSchema();
            $this->setSchema($schema);
        }
    }

    public function initByData($data)
    {
        if (!isset($data['id'])) {
            throw new \Exception('Try to retrieve incomplete data');
        }
        $this->id = $data['id'];
        foreach ($this->getSchema() as $attributeName => $attributeValue) {
            if (isset($data[$attributeName])) {
                $attributeValue = $data[$attributeName];
            }
            $this->set($attributeName, $attributeValue);
        }
        $this->initialize();
        return $this;
    }

    protected function initialize()
    {
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


    /* PROTECTED SCHEMA METHODS
     *************************************************************************/
    protected function initSchema()
    {
        throw new \LogicException('This method must be overridden');
    }

    protected function hasSchema($key = null)
    {
        if (!isset(static::$_schema[get_called_class()])) {
            return false;
        }
        if (is_null($key)) {
            return true;
        }
        $schema = static::$_schema[get_called_class()];
        return isset($schema[$key]);
    }

    protected function uniformSchema($schema)
    {
        $uniformSchema = array();
        foreach ($schema as $key => $defaultValue) {
            if (is_int($key) && is_string($defaultValue)) {
                $uniformSchema[$defaultValue] = '';
            } else {
                $uniformSchema[$key] = $defaultValue;
            }
        }
        return $uniformSchema;
    }

    protected function setSchema($schema)
    {
        $schema = $this->uniformSchema($schema);
        static::$_schema[get_called_class()] = $schema;
        return $this;
    }

    protected function getSchema($key = null)
    {
        if (!$this->hasSchema()) {
            return array();
        }
        $schema = static::$_schema[get_called_class()];
        if (is_null($key)) {
            return $schema;
        }
        if (!$this->hasSchema($key)) {
            return array();
        }
        return $schema[$key];
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