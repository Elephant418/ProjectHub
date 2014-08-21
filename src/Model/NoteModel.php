<?php

namespace ProjectHub\Model;

class NoteModel extends \ArrayObject
{


    /* ATTRIBUTES
     *************************************************************************/
    public $id;
    public $stamp;
    public $content;
    public $links = array();

    

    /* INITIALIZATION
     *************************************************************************/
    public function initByData($data)
    {
        if (! isset($data['id'])) {
            return null;
        }
        $this->id = $data['id'];
        if (isset($data['stamp']) && is_string($data['stamp'])) {
            $this->stamp = $data['stamp'];
        }
        if (isset($data['content']) && is_string($data['content'])) {
            $this->content = $data['content'];
        }
        if (isset($data['links']) && is_array($data['links'])) {
            $this->links = $data['links'];
        };
        return $this;
    }
}