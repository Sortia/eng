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

    static protected function prepareDataCreate($data)
    {
        $fields = array_keys($data);
        $values = array_values($data);

        $fields = implode(', ', $fields);
        $values = implode('\', \'', $values);

        return [$fields, $values];
    }

    static protected function prepareDataUpdate($data)
    {
        $update_arr = [];

        foreach ($data as $field => $value)
            $update_arr[] = $field . ' = \'' . $value . '\'';

        return implode(', ', $update_arr);
    }
}

Model::init();