<?php

namespace App\Models;

class Item extends Model
{
    static public $table = 'items';

    static public function read($block_id = null)
    {
        return self::$link->query("SELECT * FROM " . self::$table . " WHERE block_id = $block_id ORDER BY id desc;")->fetchAll();
    }
}