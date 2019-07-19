<?php

namespace App\Models;

use PDO;

class Model
{
    static protected $link;

    static protected $user = 'root';

    static protected $pass = '0000';

    static public function init()
    {
        self::$link = new PDO('mysql:host=localhost;dbname=eng', self::$user, self::$pass);
    }
}

Model::init();