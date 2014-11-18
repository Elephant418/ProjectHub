<?php

namespace Elephant418\Model418\Core\Model;

interface IModel
{

    public function exists();

    public function name();

    public function initByData($data);

    public function save();

    public function delete();

    public function query();
}