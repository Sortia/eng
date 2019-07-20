<?php

namespace App\Models;

class Block extends Model
{
    static public $table = 'blocks';

    static public function create($block_name)
    {
        self::$link->query("INSERT INTO " . self::$table . " (name, status) VALUES ('$block_name', 0);");

        return self::$link->query("SELECT * FROM " . self::$table . " WHERE id = (" . self::$link->lastInsertId() . ")")->fetch();
    }

    static public function read()
    {
        return self::$link->query("SELECT * FROM " . self::$table . " ORDER BY id desc;")->fetchAll();
    }

    static public function update($status, $block_id)
    {
         self::$link->query("UPDATE " . Item::$table . " SET status = '$status' WHERE block_id = '$block_id';");
         self::$link->query("UPDATE " . self::$table . " SET status = '$status' WHERE id = '$block_id';");

        return self::$link->query("SELECT * FROM block WHERE id = '$block_id'")->fetch();
    }

    static public function delete($block_id)
    {
        self::$link->query("DELETE FROM " . self::$table . " WHERE id = '$block_id';");

        return (bool)!self::$link->query("SELECT EXISTS(SELECT 1 FROM " . self::$table . " WHERE id ='$block_id' LIMIT 1)")->fetchColumn();
    }
}