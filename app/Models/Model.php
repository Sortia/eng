<?php

namespace App\Models;

use PDO;

class Model
{
    static protected $link;

    static protected $user = 'root';

    static protected $pass = '';

    static public function init()
    {
        self::$link = new PDO('mysql:host=127.0.0.1;dbname=eng', self::$user, self::$pass);
        self::$link->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
}

Model::init();