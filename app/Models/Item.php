<?php

namespace App\Models;

class Item extends Model
{
    static public $table = 'items';

    static public function read($block_id = null)
    {
        return self::$link->query("SELECT * FROM " . self::$table . " WHERE block_id = $block_id ORDER BY id desc;")->fetchAll();
    }

    static public function withBlock()
    {
        $data = self::$link->query("SELECT "
            . self::$table .".id, "
            . self::$table .".rus, "
            . self::$table .".eng, "
            . self::$table .".status, "
            . Block::$table . '.name as block_name'
            . " FROM " . self::$table
            . " LEFT JOIN " . Block::$table
            . " ON " . self::$table . ".block_id" . " = " . Block::$table . '.id')->fetchAll();

        return $data;
    }
}