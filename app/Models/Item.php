<?php

namespace App\Models;

class Item extends Model
{
    static public function create($rus, $eng, $block_id)
    {
        self::$link->query("INSERT INTO item (rus, eng, block_id) VALUES ('$rus', '$eng', '$block_id');");
    }

    static public function read($block_id)
    {
        return self::$link->query("SELECT * FROM item WHERE block_id = $block_id ORDER BY id desc;")->fetchAll();
    }

    static public function update($status, $item_id)
    {
        self::$link->query("UPDATE item SET status = '$status' WHERE id = '$item_id';");
    }

    static public function delete($rus, $eng)
    {
        self::$link->query("DELETE FROM item WHERE rus = '$rus' AND eng = '$eng';");
    }
}

// todo переделать все на id'шники