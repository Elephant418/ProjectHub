<?php

namespace Model418\Core\Request;

interface IFileRequest
{
    
    public function getContents($folder, $id);

    public function putContents($folder, $id, $data);
    
    public function exists($folder, $id);

    public function unlink($folder, $id);

    public function getFolderList($folder);
}