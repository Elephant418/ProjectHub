<?php

namespace Model418;

use Model418\Core\IQuery;
use Model418\Core\TQuery;

class Query implements IQuery
{
    use TQuery;


    /* INITIALIZATION
     *************************************************************************/
    public function __construct($model, $provider = null)
    {
        $this->_modelClass = get_class($model);
        $this->injectProvider($provider);
    }
}