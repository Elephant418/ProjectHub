<?php

namespace Elephant418\Model418\Test\Resources\NoQuery;

use Elephant418\Model418\Model;

class ResourceModel extends Model
{


    /* INITIALIZATION
     *************************************************************************/
    protected function initSchema()
    {
        return array('myName' => 'defaultValue');
    }
}