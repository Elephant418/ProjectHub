<?php

namespace Model418\Core\Request;

abstract class FileRequest implements IFileRequest
{
    
    /* ATTRIBUTES
     *************************************************************************/
    public static $extension = '';
    public static $factoryIndexList = array();
    

    /* PUBLIC METHODS
     *************************************************************************/
    public function getContents($folder, $id)
    {
        if (!$this->exists($folder, $id)) {
            return null;
        }
        $filePath = $this->getFilePath($folder, $id);
        $text = file_get_contents($filePath);
        $data = null;
        if ($text) {
            $data = $this->getDataFromText($text);
            if (is_array($data)) {
                $data['id'] = $id;
            }
        }
        return $data;
    }

    public function putContents($folder, $id, $data)
    {
        $filePath = $this->getFilePath($folder, $id);
        $text = $this->getTextFromData($data);
        return file_put_contents($filePath, $text);
    }
    
    public function exists($folder, $id)
    {
        $filePath = $this->getFilePath($folder, $id);
        return file_exists($filePath);
    }

    public function unlink($folder, $id)
    {
        $filePath = $this->getFilePath($folder, $id);
        return unlink($filePath);
    }

    public function getFolderList($folder)
    {
        $filePattern = $this->getFilePath($folder);
        return glob($filePattern);
    }


    /* STATIC METHODS
     *************************************************************************/
    public static function register()
    {
        (new FileRequestFactory)->register(get_called_class());
    }


    /* PROTECTED METHODS
     *************************************************************************/
    protected function getFilePath($folder, $id='*') {
        $filePath = $folder.'/'.$id;
        if (!static::$extension) {
            return $filePath;
        }
        return $filePath.'.'.static::$extension;
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