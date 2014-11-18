<?php

namespace Elephant418\Model418;

use Elephant418\Model418\Core\Provider\NoRelationProvider;
use Elephant418\Model418\Core\Provider\IProvider;
use Elephant418\Model418\Core\Provider\TNamedIdProvider;
use Elephant418\Model418\Core\Request\SessionRequest;

class SessionProvider extends NoRelationProvider implements IProvider
{
    use TNamedIdProvider;

    protected function initDefaultRequest()
    {
        return new SessionRequest;
    }


    /* PROTECTED METHODS
     *************************************************************************/
    protected function isIdAvailable($id)
    {
        return parent::isIdAvailable($id);
    }
}