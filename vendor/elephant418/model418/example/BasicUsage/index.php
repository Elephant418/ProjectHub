<?php

// Require composer autoload
require_once( __DIR__ . '/../../vendor/autoload.php');
use Model418\Example\BasicUsage\UserModel;

// Retrieve all models
$userList = (new UserModel)->query()->fetchAll();

// Save a new Model
$user = (new UserModel)
    ->set('firstName', 'John')
    ->save();

// Retrieve by primary key
$johnId = $user->id;
$john = (new UserModel)
    ->query()
    ->fetchById($johnId);

// Update an existing Model
$john->set('lastName', 'Doe')
    ->save();

// Access to Model attribute
echo $john->firstName.' '.$john->lastName.PHP_EOL;

// Delete an existing Model
$john->delete();