<?php

namespace App\Models;

class Block extends Model
{
    static public function create($block_name)
    {
        self::$link->query("INSERT INTO block (name, status) VALUES ('$block_name', 0);");
    }

    static public function read()
    {
        return self::$link->query("SELECT * FROM block ORDER BY id desc;");
    }

    static public function update($status, $block_id)
    {
         self::$link->query("UPDATE item SET status = '$status' WHERE block_id = '$block_id';");
         self::$link->query("UPDATE block SET status = '$status' WHERE id = '$block_id';");
    }

    static public function delete($block_name)
    {
        self::$link->beginTransaction();
        self::$link->query("
            DELETE FROM item WHERE block_id IN (SELECT id FROM block WHERE name = $block_name);
            DELETE FROM block WHERE name = '$block_name';
        ");
        self::$link->commit();
    }
}