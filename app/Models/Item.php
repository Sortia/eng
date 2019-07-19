<?php

namespace App\Models;

class Item extends Model
{
    static public $table = 'items';

    static public function create($rus, $eng, $block_id)
    {
        self::$link->query("INSERT INTO " . self::$table . " (rus, eng, block_id) VALUES ('$rus', '$eng', '$block_id');");

        return self::$link->query("SELECT * FROM " . self::$table . " WHERE id = (" . self::$link->lastInsertId() . ")")->fetch();
    }

    static public function read($block_id)
    {
        return self::$link->query("SELECT * FROM " . self::$table . " WHERE block_id = $block_id ORDER BY id desc;")->fetchAll();
    }

    static public function update($status, $item_id)
    {
        self::$link->query("UPDATE " . self::$table . " SET status = '$status' WHERE id = '$item_id';");

        return self::$link->query("SELECT * FROM " . self::$table . " WHERE id = '$item_id'")->fetch();
    }

    static public function delete($item_id)
    {
        self::$link->query("DELETE FROM " . self::$table . " WHERE id = '$item_id';");

        return (bool)!self::$link->query("SELECT EXISTS(SELECT 1 FROM " . self::$table . " WHERE id ='$item_id' LIMIT 1)")->fetchColumn();

    }
}