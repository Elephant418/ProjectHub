<?php

namespace ProjectHub\Model;

use ProjectHub\Model\NoteModel;

class ProjectModel extends \ProjectHub\Model
{


    /* ATTRIBUTES
     *************************************************************************/
    public $schema =array(
        'name' => '',
        'timeline' => array()
    );
    
    

    /* INITIALIZATION
     *************************************************************************/
    protected function initialization()
    {
        if ($this->timeline) {
            $timeline = array();
            foreach ($this->timeline as $index => $noteData) {
                $noteData['id'] = $index;
                $note = (new NoteModel)->initByData($noteData);
                $timeline[] = $note;
            }
            $this->timeline = $timeline;
        }
    }
}