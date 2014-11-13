<?php

namespace Model418\Core\Request;

class TextFileRequest extends FileRequest
{

    /* ATTRIBUTES
     *************************************************************************/
    public static $extension = 'txt';
    public static $factoryIndexList = array('text', 'txt');


    /* PROTECTED METHODS
     *************************************************************************/
    protected function getDataFromText($text)
    {
        return $text;
    }
    
    protected function getTextFromData($data)
    {
        if (!is_string($data)) {
            throw new \RuntimeException('Wrong type of data to markdownify: '.get_type($data));
        }
        return $data;
    }
}