<?php

$composerAutoloadFilePathList = array(
    __DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/../../../autoload.php'
);

foreach ($composerAutoloadFilePathList as $filePath) {
    if (file_exists($filePath)) {
        require_once($filePath);
        break;
    }
}