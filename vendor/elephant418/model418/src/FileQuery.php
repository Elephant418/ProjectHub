<?php

namespace Model418;

class FileQuery extends Query
{
    protected $folder;
    
    public function __construct($model, $folder) {
        $this->folder = $folder;
        parent::__construct($model);
    }
    
    protected function initProvider()
    {
        $provider = (new FileProvider)
            ->setFolder($this->folder);
        return $provider;
    }
}