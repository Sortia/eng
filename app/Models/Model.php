<?php

namespace App\Models;

class Model
{
    static protected $link;

    static public function init()
    {
        self::$link = mysqli_connect("127.0.0.1", "root", "0000", "eng");
    }
}

Model::init();