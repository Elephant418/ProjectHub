<?php

namespace Model418;

use Model418\Core\IQuery;
use Model418\Core\TQuery;

class ModelQuery extends Model implements IQuery
{
    use TQuery;


    /* INITIALIZATION
     *************************************************************************/
    public function __construct($provider = null)
    {
        parent::__construct();
        $this->_modelClass = get_called_class();
        $this->injectProvider($provider);
    }


    /* PROTECTED ENTITY METHODS
     *************************************************************************/
    protected function initQuery()
    {
        return $this;
    }
}