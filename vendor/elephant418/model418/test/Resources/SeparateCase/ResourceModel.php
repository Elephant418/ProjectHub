<?php

namespace Test\Model418\Resources\SeparateCase;

use Model418\Model;

class ResourceModel extends Model
{


    /* INITIALIZATION
     *************************************************************************/
    protected function initSchema()
    {
        return array('myName' => 'defaultValue');
    }
    
    protected function initQuery()
    {
        return new ResourceQuery($this);
    }
}