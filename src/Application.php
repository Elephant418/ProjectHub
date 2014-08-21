<?php

namespace ProjectHub;

define('ROOT_PATH', dirname(__DIR__));

require_once __DIR__ . '/Autoloader.php';

use ProjectHub\Entity\TimeLineEntity;

class Application
{

    public function index()
    {
        var_dump((new TimeLineEntity)->fetchAll());
    }

}