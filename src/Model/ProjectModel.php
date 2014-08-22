<?php

namespace ProjectHub\Model;

use ProjectHub\Model\NoteModel;

class ProjectModel extends \ProjectHub\Model
{


    /* ATTRIBUTES
     *************************************************************************/
    public $schema =array(
        'date' => '',
        'stamp' => '',
        'name' => '',
        'timeline' => array()
    );
    
    

    /* INITIALIZATION
     *************************************************************************/
    protected function initialization()
    {
        $this->initializeTimeline();
        $this->initializeStamp();
    }
    
    protected function initializeTimeline()
    {
        $timeline = array();
        if (is_array($this->timeline)) {
            foreach ($this->timeline as $index => $noteData) {
                $noteData['id'] = $index;
                $note = (new NoteModel)->initByData($noteData);
                $timeline[] = $note;
            }
        }
        $this->timeline = $timeline;
    }

    protected function initializeStamp()
    {
        $dateList = array();
        foreach ($this->timeline as $note) {
            if (is_object($note->date)) {
                $dateList[] = $note->date;
            }
        }
        if (count($dateList)) {
            $this->date = max($dateList);
            $this->stamp = $this->date->format("F j, Y");
        }
    }
}