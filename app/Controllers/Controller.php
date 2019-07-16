<?php


namespace Controllers;


class Controller
{
    protected $link;

    public function __construct()
    {
        $this->link = mysqli_connect("127.0.0.1", "root", "", "eng");
    }

    public function __destruct()
    {
        mysqli_close($this->link);
    }
}