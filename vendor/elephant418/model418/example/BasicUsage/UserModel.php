<?php

namespace Model418\Example\BasicUsage;

use Model418\Model;
use Model418\FileQuery;

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