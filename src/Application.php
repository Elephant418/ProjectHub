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


    
    /* PUBLIC METHODS
     *************************************************************************/
    public function index()
    {
        $project = (new ProjectEntity)->fetchById('sample');
        $application = $this;
        require_once(ROOT_PATH.'/template/index.php');
    }

}