<?php

namespace Elephant418\Model418\Core\Request\FileRequest;

use Elephant418\Model418\Core\Request\FileRequest;

class JSONFileRequest extends FileRequest
{

    /* ATTRIBUTES
     *************************************************************************/
    public static $extension = 'json';
    public static $factoryIndexList = array('json');


    /* PROTECTED METHODS
     *************************************************************************/
    protected function getDataFromText($text)
    {
        $data = json_decode($text, true);
        if (!is_array($data)) {
            return null;
        }
        return $data;
    }
    
    protected function getTextFromData($data)
    {
        return json_encode($data);
    }
}