<?php

namespace Controllers;

abstract class Controller
{
    protected array $request;
    protected string $path;

    abstract public function postCreate();

    abstract public function postUpdate();

    abstract public function postDelete();

    public function __construct()
    {
        $this->request = $_REQUEST;
        $this->path = $_SERVER['REQUEST_URI'];
    }
}