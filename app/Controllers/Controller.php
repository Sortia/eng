<?php

namespace Controllers;

abstract class Controller
{
    protected $request;

    protected $path;

    abstract public function postCreate();

    abstract public function postUpdate();

    abstract public function postDelete();

    public function __construct()
    {
        $this->request = $_REQUEST;
        $this->path = array_unset_val($this->request, 'path');
    }
}