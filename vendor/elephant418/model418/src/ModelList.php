<?php

namespace Elephant418\Model418;

use Elephant418\Model418\Core\ListObject;

class ModelList extends ListObject
{


    /* INITIALIZATION
     *************************************************************************/
    public function init($modelArray)
    {
        $this->exchangeArray($modelArray);
        return $this;
    }


    /* FILTERING METHODS
     *************************************************************************/
    public function filter($name, $value)
    {
        $this->exchangeArray(array_filter($this->toArray(), function($model) use ($name, $value) {
            return ($model->get($name) === $value);
        }));
        return $this;
    }


    /* GETTER & SETTER
     *************************************************************************/
    public function get($name)
    {
        $valueList = array();
        foreach ($this as $model) {
            $valueList[$model->id] = $model->get($name);
        }
        return $valueList;
    }

    public function set($name, $value)
    {
        foreach ($this as $model) {
            $model->set($name, $value);
        }
        return $this;
    }


    /* PUBLIC STORING METHODS
     *************************************************************************/
    public function save()
    {
        foreach ($this as $model) {
            $model->save();
        }
        return $this;
    }

    public function delete()
    {
        foreach ($this as $model) {
            $model->delete();
        }
        return $this;
    }
}