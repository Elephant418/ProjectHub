<?php

namespace ProjectHub\Model;

use Elephant418\Model418\FlatModel;

class NoteModel extends FlatModel
{


    /* INITIALIZATION
     *************************************************************************/
    protected function initSchema()
    {
        return array(
            'date',
            'stamp',
            'content',
            'links' => array()
        );
    }
    
    protected function initialize()
    {
        $time = strtotime($this->stamp);
        if ($time !== false) {
            $this->date = new \DateTime($this->stamp);
            $this->stamp = $this->date->format("F j, Y");
        }
        if (!is_array($this->links)) {
            $this->links = array();
        }
    }
}