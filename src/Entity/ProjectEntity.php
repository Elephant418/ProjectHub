<?php

namespace ProjectHub\Entity;

class ProjectEntity extends \ProjectHub\Entity
{


    /* ATTRIBUTES
     *************************************************************************/
    protected $modelClass = 'ProjectHub\\Model\\ProjectModel';
    protected $dataFolder = '/data';



    /* FETCHING METHODS
     *************************************************************************/
    public function fetchAll($limit = null, $offset = null, &$count = false)
    {
        $projectList = parent::fetchAll($limit, $offset, $count);
        usort($projectList, array($this, 'compareDate'));
        return $projectList;
    }
    
    protected function compareDate($a, $b)
    {
        if ($a->date == $b->date) {
            return 0;
        }
        return ($a->date > $b->date) ? -1 : 1;
    }

}