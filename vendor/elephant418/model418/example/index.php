<?php

session_start();

// Require composer autoload
require_once(__DIR__ . '/../vendor/autoload.php');
//use Elephant418\Model418\Example\BasicUsage\UserModel;
use Elephant418\Model418\Example\JSONProvider\UserModel;
// use Elephant418\Model418\Example\SessionProvider\UserModel;

function dumpUser($user) {
    return $user->firstName.' '.$user->lastName.' ('.$user->id.')'.PHP_EOL;
}

// Retrieve all models
$userList = (new UserModel)->query()->fetchAll();
foreach ($userList as $user) {
    echo 'Existing: '.dumpUser($user);
}
echo '---'.PHP_EOL;

// Save a new Model
$user = (new UserModel)
    ->set('firstName', 'John')
    ->save();

echo 'Added:    '.dumpUser($user);

// Retrieve by primary key
$johnId = $user->id;
$john = (new UserModel)
    ->query()
    ->fetchById($johnId);

// Update an existing Model
$john->set('lastName', 'Doe')
    ->save();

// Access to Model attribute
echo 'Updated:  '.dumpUser($john);

// Delete an existing Model
$john->delete();