<?php

namespace Elephant418\Model418\Example\SessionProvider;

use Elephant418\Model418\ModelQuery;
use Elephant418\Model418\SessionProvider as Provider;

class UserModel extends ModelQuery
{


    /* INITIALIZATION
     *************************************************************************/
    protected function initProvider()
    {
        $provider = (new Provider)
            ->setKey('User')
            ->setIdField('myName');
        return $provider;
    }
}