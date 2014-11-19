<?php

namespace Elephant418\Model418\Core\Request;

use Elephant418\Model418\Core\Request\FileRequest\FileRequestFactory;

abstract class FileRequest implements IKeyValueRequest
{
    
    /* ATTRIBUTES
     *************************************************************************/
    public static $extension = '';
    public static $factoryIndexList = array();
    

    /* PUBLIC METHODS
     *************************************************************************/
    public function getContents($folderList, $id)
    {
        $data = null;
        $folderList = $this->formatToFolderList($folderList);
        foreach ($folderList as $folder) {
            if (!$this->exists($folder, $id)) {
                continue;
            }
            $filePath = $this->getFilePath($folder, $id);
            $text = file_get_contents($filePath);
            if ($text) {
                $data = $this->getDataFromText($text);
                if (is_array($data)) {
                    $data['id'] = $id;
                }
                break;
            }
        }
        return $data;
    }

    public function putContents($folderList, $id, $data)
    {
        $folderList = $this->formatToFolderList($folderList);
        $filePath = $this->getExistingFilePath($folderList, $id);
        if (!$filePath) {
            $filePath = $this->getFilePath(reset($folderList), $id);
        }
        $text = $this->getTextFromData($data);
        return file_put_contents($filePath, $text);
    }
    
    public function exists($folderList, $id)
    {
        $folderList = $this->formatToFolderList($folderList);
        $filePath = $this->getExistingFilePath($folderList, $id);
        return !!$filePath;
    }

    public function unlink($folderList, $id)
    {
        $folderList = $this->formatToFolderList($folderList);
        $filePath = $this->getExistingFilePath($folderList, $id);
        if ($filePath) {
            return unlink($filePath);
        }
        return false;
    }

    public function getIdList($folderList)
    {
        $idList = array();
        $folderList = $this->formatToFolderList($folderList);
        foreach ($folderList as $folder) {
            $filePattern = $this->getFilePath($folder);
            $fileList = glob($filePattern);
            foreach ($fileList as $file) {
                $file = basename($file);
                $id = substr($file, 0, strrpos($file, '.'));
                $idList[] = $id;
            }
        }
        return array_unique($idList);
    }


    /* STATIC METHODS
     *************************************************************************/
    public static function register()
    {
        (new FileRequestFactory)->register(get_called_class(), static::$factoryIndexList);
    }


    /* PROTECTED METHODS
     *************************************************************************/
    protected function formatToFolderList($folderList) {
        if (!is_array($folderList)) {
            $folderList = array($folderList);
        }
        return $folderList;
    }
    
    protected function getFilePath($folder, $id='*') {
        $filePath = $folder.'/'.$id;
        if (!static::$extension) {
            return $filePath;
        }
        return $filePath.'.'.static::$extension;
    }

    protected function getExistingFilePath($folderList, $id) {
        foreach ($folderList as $folder) {
            $filePath = $this->getFilePath($folder, $id);
            if (file_exists($filePath)) {
                return $filePath;
            }
        }
        return false;
    }
    
    protected function getDataFromText($text)
    {
        throw new \LogicException('This method must be overridden');
    }

    protected function getTextFromData($data)
    {
        throw new \LogicException('This method must be overridden');
    }
}