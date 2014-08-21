<?php

namespace ProjectHub\Model;

use ProjectHub\Model\NoteModel;

class ProjectModel extends \ArrayObject
{


    /* ATTRIBUTES
     *************************************************************************/
    public $id;
    public $name = array();
    public $timeline = array();

    

    /* INITIALIZATION
     *************************************************************************/
    public function initByData($data)
    {
        if (! isset($data['id'])) {
            return null;
        }
        $this->id = $data['id'];
        if (isset($data['name']) && is_string($data['name'])) {
            $this->name = $data['name'];
        }
        if (isset($data['timeline']) && is_array($data['timeline'])) {
            $this->timeline = $data['timeline'];
        };
        return $this;
    }
}