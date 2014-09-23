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
        $projectEntity = new ProjectEntity;
        $projectList = $projectEntity->fetchAll();
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
        $projectEntity = new ProjectEntity;
        $projectList = $projectEntity->fetchAll();
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
        $this->render('project', array('project'=> $project, 'projectCount'=> $projectCount));
    }
    
    public function renderProjectList($projectList)
    {
        $this->render('home', array('projectList'=> $projectList));
    }

    public function renderTutorial()
    {
        $this->render('welcome');
    }

    public function render404()
    {
        $this->render('404');
    }
    
    public function render($page, $vars = array())
    {
        extract($vars);
        ob_start();
        
        $application = $this;
        require(ROOT_PATH.'/template/'.$page.'.php');

        $html = ob_get_contents();
        ob_end_clean();

        echo $html;
    }

}