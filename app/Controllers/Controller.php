<?php

namespace Controllers;

abstract class Controller
{
    protected $request;

    abstract public function postCreate();

    abstract public function postUpdate();

    abstract public function postDelete();

    public function __construct()
    {
        $this->request = $_REQUEST;
    }
}