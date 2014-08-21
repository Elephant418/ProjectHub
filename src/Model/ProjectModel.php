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
            $timeline = array();
            foreach ($data['timeline'] as $index => $noteData) {
                $noteData['id'] = $index;
                $note = (new NoteModel)->initByData($noteData);
                $timeline[] = $note;
            }
            $this->timeline = $timeline;
        };
        return $this;
    }
}