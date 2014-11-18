<?php

namespace Elephant418\Model418\Example\JSONProvider;

use Elephant418\Model418\ModelQuery;
use Elephant418\Model418\FileProvider as Provider;

class UserModel extends ModelQuery
{


    /* INITIALIZATION
     *************************************************************************/
    protected function initProvider()
    {
        $provider = (new Provider)
            ->setRequest('JSON')
            ->setFolder(__DIR__ . '/User')
            ->setIdField('myName');
        return $provider;
    }
}