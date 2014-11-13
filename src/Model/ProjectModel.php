<?php

namespace ProjectHub\Model;

use Model418\FileProvider as Provider;
use Model418\ModelQuery;

class ProjectModel extends ModelQuery
{
    

    /* MODEL METHODS
     *************************************************************************/
    protected function initSchema()
    {
        return array(
            'date',
            'stamp',
            'name',
            'timeline' => array()
        );
    }
    
    protected function initialize()
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
                $noteModel = (new NoteModel)->initByData($noteData);
                $timeline[] = $noteModel;
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


    /* QUERY METHODS
     *************************************************************************/
    protected function initProvider()
    {
        $provider = (new Provider)
            ->setFolder(__DIR__ . '/../../data')
            ->setIdField('name');
        return $provider;
    }
    
    public function fetchAll($limit = null, $offset = null, &$count = false)
    {
        $projectList = parent::fetchAll($limit, $offset, $count);
        $projectList->uasort(array($this, 'compareDate'));
        return $projectList;
    }

    public function compareDate($a, $b)
    {
        if ($a->date == $b->date) {
            return 0;
        }
        return ($a->date > $b->date) ? -1 : 1;
    }

}