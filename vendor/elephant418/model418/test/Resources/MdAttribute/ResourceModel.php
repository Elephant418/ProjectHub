<?php

namespace Elephant418\Model418\Test\Resources\MdAttribute;

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
            ->setSubAttribute('content', 'article', 'md')
            ->setIdField('myName');
        return $provider;
    }

    protected function initSchema()
    {
        return array(
            'myName' => 'defaultValue',
            'content' => ''
        );
    }


    /* FETCHING METHODS
     *************************************************************************/
    public function fetchTest()
    {
        return $this->fetchById('test');
    }
}