<?php

namespace Model418\Core;

interface IModel
{

    public function exists();

    public function name();

    public function initByData($data);

    public function save();

    public function delete();

    public function query();
}