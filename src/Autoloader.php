<?php

namespace ProjectHub;

class Autoloader
{

    public function autoload($class)
    {
        $namespacePartList = explode('\\', $class);
        $rootNamespace = $namespacePartList[0];
        if ($rootNamespace == __NAMESPACE__) {
            array_shift($namespacePartList);
            $classFilePath = implode(DIRECTORY_SEPARATOR, $namespacePartList) . '.php';
            require_once __DIR__ . DIRECTORY_SEPARATOR . $classFilePath;
        }
    }
}

$autoloader = new Autoloader();
spl_autoload_register(array($autoloader, 'autoload'));