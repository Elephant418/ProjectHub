<?php

namespace ProjectHub;

define('ROOT_PATH', dirname(__DIR__));

require_once __DIR__ . '/Autoloader.php';

use ProjectHub\Entity\ProjectEntity;

class Application
{


    /* ATTRIBUTES
     *************************************************************************/
    public $publicBaseUri = '/public';


    
    /* PUBLIC ACTION METHODS
     *************************************************************************/
    public function index()
    {
        if (isset($_GET['project'])) {
            $result = $this->one($_GET['project']);
        } else {
            $result = $this->all();
        }
        if (!$result) {
            $this->render404();
        }
        die;
    }
    
    public function all()
    {
        $projectList = (new ProjectEntity)->fetchAll();
        if (count($projectList) == 0) {
            $this->renderTutorial();
        } else if (count($projectList) == 1) {
            $project = array_pop($projectList);
            $this->renderProject($project, 1);
        } else {
            $this->renderProjectList($projectList);
        }
        return true;
    }
    
    public function one($projectId)
    {
        $projectList = (new ProjectEntity)->fetchAll();
        if (!isset($projectList[$projectId])) {
            return false;
        }
        $project = $projectList[$projectId];
        $this->renderProject($project, count($projectList));
        return true;
    }



    /* PROTECTED METHODS
     *************************************************************************/
    public function renderProject($project, $projectCount)
    {
        $application = $this;
        require_once(ROOT_PATH.'/template/project.php');
    }
    
    public function renderProjectList($projectList)
    {
        $application = $this;
        require_once(ROOT_PATH.'/template/home.php');
    }

    public function renderTutorial()
    {
        echo 'You have no project, you can add one in your data folder';
    }

    public function render404()
    {
        echo 'Error 404';
    }

}