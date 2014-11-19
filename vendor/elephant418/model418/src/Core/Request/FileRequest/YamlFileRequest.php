<?php

namespace Elephant418\Model418\Core\Request\FileRequest;

use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;
use Elephant418\Model418\Core\Request\FileRequest;

class YamlFileRequest extends FileRequest
{

    /* ATTRIBUTES
     *************************************************************************/
    public static $extension = 'yml';
    public static $factoryIndexList = array('yaml', 'yml');


    /* PROTECTED METHODS
     *************************************************************************/
    protected function getDataFromText($text)
    {
        try {
            $data = Yaml::parse($text);
        } catch (ParseException $e) {
            return null;
        }
        return $data;
    }
    
    protected function getTextFromData($data)
    {
        if (!is_array($data)) {
            throw new \RuntimeException('Wrong type of data to markdownify: '.get_type($data));
        }
        return Yaml::dump($data, 3);
    }
}