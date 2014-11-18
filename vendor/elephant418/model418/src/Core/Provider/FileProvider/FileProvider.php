<?php

namespace Elephant418\Model418\Core\Provider\FileProvider;

use Elephant418\Model418\Core\Provider\IProvider;
use Elephant418\Model418\Core\Provider\CacheDumpProvider;
use Elephant418\Model418\Core\Provider\TNamedIdProvider;
use Elephant418\Model418\Core\Request\FileRequestFactory;
use Elephant418\Model418\Core\Request\TextFileRequest;
use Elephant418\Model418\Core\Request\JSONFileRequest;
use Elephant418\Model418\Core\Request\YamlFileRequest;
use Elephant418\Model418\Core\Request\MarkdownFileRequest;

TextFileRequest::register();
JSONFileRequest::register();
YamlFileRequest::register();
MarkdownFileRequest::register();

class FileProvider extends CacheDumpProvider implements IProvider
{
    use TNamedIdProvider;


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
            $format = (new FileRequestFactory)->get($format);
        }
        return $format;
    }
}