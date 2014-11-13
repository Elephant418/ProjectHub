Model418
=====
[![Latest Stable Version](https://poser.pugx.org/elephant418/model418/v/stable.svg)](https://github.com/Elephant418/Model418)
[![Build Status](https://travis-ci.org/Elephant418/Model418.png?branch=master)](https://travis-ci.org/Elephant418/Model418)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Elephant418/Model418/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/Elephant418/Model418/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/Elephant418/Model418/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/Elephant418/Model418/?branch=master)
[![Total Downloads](https://poser.pugx.org/elephant418/model418/downloads.svg)](https://packagist.org/packages/elephant418/model418)
[![License](https://poser.pugx.org/elephant418/model418/license.svg)](http://opensource.org/licenses/MIT)



Model418 is a nice-to-use & highly flexible `ORM`.<br>
It maps your data, from a database or another source, and its relationships into accessible objects.<br>
It could be used with or without a framework.

1. [Features](#features)
2. [Let's code](#lets-code)
3. [How to Install](#how-to-install)
4. [How to Contribute](#how-to-contribute)
5. [Author & Community](#author--community)



Features
--------

For now, Model418 supports only *File system* storage with the following encoding:

 * Yaml (default), JSON, Text and Markdown.

[&uarr; top](#readme)



Let's code
--------

```php
// Retrieve all models
$userList = (new UserModel)->query()->fetchAll();

// Save a new Model
$user = (new UserModel)
    ->set('firstName', 'John')
    ->save();
    
// Retrieve by primary key
$john = (new UserModel)->query()->fetchById(1);
    
// Update an existing Model
$john->set('lastName', 'Doe')
    ->save();
    
// Delete an existing Model
$john->delete();
```

To go further, you should read [the complete documentation](https://github.com/Elephant418/Model418/blob/master/doc/Index.md).

[&uarr; top](#readme)



How to Install
--------

This library package requires `PHP 5.4` or later.<br>
Install [Composer](http://getcomposer.org/doc/01-basic-usage.md#installation) and run the following command to get the latest version:

```sh
composer require elephant418/model418:~1.0
```

[&uarr; top](#readme)



How to Contribute
--------

### Get involved

1. [Star](https://github.com/elephant418/model418/stargazers) the project!
2. [Report a bug](https://github.com/elephant418/model418/issues/new) that you find
3. Tweet and blog about Model418 and [Let me know](https://twitter.com/iamtzi) about it.

### Pull Requests

Pull requests are highly appreciated.<br>
Please review the [guidelines for contributing](https://github.com/Elephant418/Model418/blob/master/CONTRIBUTING.md) to go further. 

[&uarr; top](#readme)



Author & Community
--------

Model418 is under [MIT License](http://opensource.org/licenses/MIT).<br>
It was created & maintained by [Thomas ZILLIOX](http://tzi.fr).
