<?php

namespace Elephant418\Model418\Core\Provider\Aspect;

use Elephant418\Model418\Core\Provider\IProvider;
use Elephant418\Model418\Core\Request\FileRequest\FileRequestFactory;
use Elephant418\Model418\Core\Request\FileRequest\TextFileRequest;
use Elephant418\Model418\Core\Request\FileRequest\JSONFileRequest;
use Elephant418\Model418\Core\Request\FileRequest\YamlFileRequest;
use Elephant418\Model418\Core\Request\FileRequest\MarkdownFileRequest;

abstract class FileProvider extends RuntimeCacheKeyValueProvider implements IProvider
{
    use TNamedIdProvider;


    /* INITIALIZATION
     *************************************************************************/
    public function __construct() {
        TextFileRequest::register();
        JSONFileRequest::register();
        YamlFileRequest::register();
        MarkdownFileRequest::register();
    }


    /* FOLDER METHODS
     *************************************************************************/
    public function getFolder()
    {
        $key = $this->getKey();
        return reset($key);
    }

    public function setFolder($folder)
    {
        return $this->setKey($folder);
    }

    public function getFolderList()
    {
        return $this->getKey();
    }

    public function setFolderList($folderList)
    {
        return $this->setKey($folderList);
    }
    
    public function setKey($key)
    {
        if (!is_array($key)) {
            $key = array($key);
        }
        foreach ($key as $index => $folder) {
            $key[$index] = $this->validFolder($folder);
        }
        parent::setKey($key);
        return $this;
    }

    protected function validFolder($folder)
    {
        $realFolder = realpath($folder);
        if (!$realFolder) {
            throw new \RuntimeException('This data folder does not exist: ' . $folder);
        }
        return $realFolder;
    }


    /* PROTECTED METHODS
     *************************************************************************/
    protected function isIdAvailable($id)
    {
        return parent::isIdAvailable($id);
    }


    /* FILE REQUEST METHODS
     *************************************************************************/
    public function setRequest($format)
    {
        parent::setRequest($this->getRequestFromName($format));
        return $this;
    }
    
    protected function initDefaultRequest()
    {
        return 'yml';
    }
    
    protected function getRequestFromName($format)
    {
        if (is_string($format)) {
            $format = (new FileRequestFactory)->newInstance($format);
        }
        return $format;
    }
}