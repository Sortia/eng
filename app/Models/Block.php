<?php

namespace App\Models;

class Block extends Model
{
    static public function create($block_name)
    {
        self::$link->query("INSERT INTO block (name, status) VALUES ('$block_name', 0);");

        return self::$link->query("SELECT * FROM block WHERE id = (" . self::$link->lastInsertId() . ")")->fetch();
    }

    static public function read()
    {
        return self::$link->query("SELECT * FROM block ORDER BY id desc;")->fetchAll();
    }

    static public function update($status, $block_id)
    {
         self::$link->query("UPDATE item SET status = '$status' WHERE block_id = '$block_id';");
         self::$link->query("UPDATE block SET status = '$status' WHERE id = '$block_id';");

        return self::$link->query("SELECT * FROM block WHERE id = '$block_id'")->fetch();
    }

    static public function delete($block_id)
    {
        self::$link->beginTransaction();
        self::$link->query("
            DELETE FROM item WHERE block_id = '$block_id';
            DELETE FROM block WHERE id = '$block_id';
        ");
        self::$link->commit();

        return (bool)!self::$link->query("SELECT EXISTS(SELECT 1 FROM item WHERE id ='$block_id' LIMIT 1)")->fetchColumn();
    }
}