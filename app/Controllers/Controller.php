<?php

namespace Controllers;

abstract class Controller
{
    protected array $request;

    protected array $files;

    protected array $session;

    protected string $path;

    public function __construct()
    {
        $this->session = &$_SESSION;
        $this->files = $_FILES;
        $this->request = $_REQUEST;
        $this->path = $_SERVER['REQUEST_URI'];
    }
}