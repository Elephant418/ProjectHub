<?php

namespace ProjectHub\Model;

class NoteModel extends \ProjectHub\Model
{


    /* ATTRIBUTES
     *************************************************************************/
    public $schema =array(
        'date' => '',
        'stamp' => '',
        'content' => '',
        'links' => array()
    );



    /* INITIALIZATION
     *************************************************************************/
    protected function initialization()
    {
        $time = strtotime($this->stamp);
        if ($time !== false) {
            $this->date = new \DateTime($this->stamp);
            $this->stamp = $this->date->format("F j, Y");
        }
    }
}