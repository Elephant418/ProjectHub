<?php

namespace ProjectHub\Model;

class TimeLineModel extends \ArrayObject
{


    /* ATTRIBUTES
     *************************************************************************/
    protected $id;
    protected $noteList = array();

    

    /* INITIALIZATION
     *************************************************************************/
    public function initByData($data)
    {
        if (! isset($data['id'])) {
            return null;
        }
        $this->id = $data['id'];
        if (is_array($data['timeline'])) {
            $this->noteList = $data['timeline'];
        };
        return $this;
    }
}