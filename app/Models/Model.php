<?php

namespace App\Models;

use PDO;

class Model
{
    static protected PDO $link;

    static private string $user = 'root';

    static private string $pass = 'root';

    static private string $dbname = 'eng';

    static private string $host = 'mysql';

    static public string $table = '';

    static public array $fill = [];

    static public function init()
    {
        self::$link = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$dbname, self::$user, self::$pass);
        self::$link->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    static protected function prepareDataCreate($data): array
    {
        $data = array_intersect_key($data, array_flip(static::$fill));

        $fields = array_keys($data);
        $values = array_values($data);

        $fields = implode(', ', $fields);
        $values = '\'' . implode('\', \'', $values) . '\'';

        return [$fields, $values];
    }

    static protected function prepareDataUpdate($data): string
    {
        $data = array_intersect_key($data, array_flip(static::$fill));

        $update_arr = [];

        foreach ($data as $field => $value)
            $update_arr[] = $field . ' = \'' . $value . '\'';

        return implode(', ', $update_arr);
    }

    static public function create($data): array
    {
        list($data_keys, $data_values) = self::prepareDataCreate($data);

        self::$link->query("INSERT INTO " . static::$table . " ({$data_keys}) VALUES ({$data_values});");

        return self::$link->query("SELECT * FROM " . static::$table . " WHERE id = (" . self::$link->lastInsertId() . ")")->fetch();
    }

    static public function read($param = null): array
    {
        return $data = self::$link->query("SELECT * FROM " . static::$table . " ORDER BY id desc;")->fetchAll();
    }

    static public function update($data): array
    {
        $prepared_data = self::prepareDataUpdate($data);

        self::$link->query("UPDATE " . static::$table . " SET {$prepared_data} WHERE id = '{$data['id']}';");

        return self::$link->query("SELECT * FROM " . static::$table . " WHERE id = '{$data['id']}'")->fetch();
    }

    static public function delete($id): bool
    {
        self::$link->query("DELETE FROM " . static::$table . " WHERE id = '$id';");

        return (bool)!self::$link->query("SELECT EXISTS(SELECT 1 FROM " . static::$table . " WHERE id ='$id' LIMIT 1)")->fetchColumn();
    }
}

Model::init();