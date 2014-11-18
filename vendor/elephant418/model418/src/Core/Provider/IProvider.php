<?php

namespace Elephant418\Model418\Core\Provider;

interface IProvider
{

    public function fetchById($id);

    public function fetchByIdList($idList);

    public function fetchAll($limit = null, $offset = null, &$count = false);

    public function saveById($id, $data);

    public function deleteById($id);
}