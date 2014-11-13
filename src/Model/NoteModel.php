<?php

namespace ProjectHub\Model;

use Model418\Model;

class NoteModel extends Model
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
    
    protected function initQuery()
    {
        // No Query
        return null;
    }
    
    protected function initialize()
    {
        $time = strtotime($this->stamp);
        if ($time !== false) {
            $this->date = new \DateTime($this->stamp);
            $this->stamp = $this->date->format("F j, Y");
        }
    }
}