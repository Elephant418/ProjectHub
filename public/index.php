<?php

require_once __DIR__.'/../src/Application.php';

use ProjectHub\Model\ProjectModel;
use ProjectHub\Model\NoteModel;

$application = new \ProjectHub\Application();
$application
    ->register(ProjectModel::class, 'Project')
    ->register(NoteModel::class, 'Note')
    ->index();