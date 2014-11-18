Quick Start
======

1. [Install](#install)
2. [Basic Usage](#basic-usage)
3. [Define Storage Folder](#define-storage-folder)
4. [Define A Model Schema](#define-a-model-schema)



Install
--------

Install [Composer](http://getcomposer.org/doc/01-basic-usage.md#installation) and run the following command:

```sh
composer require elephant418/model418:~1.1
```



Basic Usage
--------

Start by defining a model with the `ModelQuery` starter class:

```php
use Elephant418\Model418\ModelQuery;

class UserModel extends ModelQuery
{
}
```

```php
// Require composer autoload
require_once( __DIR__ . '/path/to/vendor/autoload.php');
use My\Project\Namespace\Model\UserModel;

// Retrieve all models
$userList = (new UserModel)->query()->fetchAll();
echo count($userList);

// Save a new Model
// And create a `data/UserModel/1.yml` file
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



Define Storage Folder
--------

You can define in which folder you want to store your data, by overriding the `initFolder()` method:

```php
class UserModel extends ModelQuery
{
    protected function initFolder()
    {
        // Return the path where you want to store your data.
        return __DIR__.'/../data/User';
    }
}
```



Define A Model Schema
--------

You can define an exclusive list of attribute for your model:

```php
class UserModel extends ModelQuery
{
    protected function initSchema()
    {
        // The list of the attributes of your model
        return array('firstName', 'lastName');
    }
}
```

If a schema is set, you could not set another attribute: 

```php
// Throw RuntimeException
$user = (new UserModel)
    ->set('age', '30')
    ->save();
```
