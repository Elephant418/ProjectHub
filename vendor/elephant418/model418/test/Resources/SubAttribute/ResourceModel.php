<?php

namespace Elephant418\Model418\Test\Resources\SubAttribute;

use Elephant418\Model418\FileProvider as Provider;
use Elephant418\Model418\ModelQuery;

class ResourceModel extends ModelQuery
{


    /* INITIALIZATION
     *************************************************************************/
    protected function initProvider()
    {
        $provider = (new Provider)
            ->setFolder(__DIR__ . '/../data')
            ->setSubAttribute('event')
            ->setIdField('myName');
        return $provider;
    }

    protected function initSchema()
    {
        return array(
            'myName' => 'defaultValue',
            'event' => array()
        );
    }


    /* FETCHING METHODS
     *************************************************************************/
    public function fetchTest()
    {
        return $this->fetchById('test');
    }
}