Quick Start
======

1. [Install](#install)
2. [Define a Model](#define-a-model)
3. [Basic Usage](#basic-usage)



Install
--------

Install [Composer](http://getcomposer.org/doc/01-basic-usage.md#installation) and run the following command:

```sh
composer require elephant418/model418:~1.0
```



Define a Model
--------

Start by defining a model

```php
use Model418\Model;

class UserModel extends Model
{

    // The list of the attributes of your model
    protected function initSchema()
    {
        return array('firstName', 'lastName');
    }
    
    // An instance of the associated Query.
    // It will be used to query the storage system, in this case the file system.
    protected function initQuery()
    {
        // Instance a FileQuery and set the folder that will be used for storage
        return new FileQuery($this, __DIR__.'/User');
    }
}
```

[&uarr; top](#readme)



Basic Usage
--------

```php
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
```

[&uarr; top](#readme)