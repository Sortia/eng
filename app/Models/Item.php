<?php

namespace App\Models;

class Item extends Model
{
    static public string $table = 'items';

    static public function read($flashcard_id = null) : array
    {
        return self::$link->query("SELECT * FROM " . self::$table . " WHERE flashcard_id = $flashcard_id ORDER BY id desc;")->fetchAll();
    }

    static public function withFlashcard() : array
    {
        $data = self::$link->query("SELECT "
            . self::$table .".id, "
            . self::$table .".rus, "
            . self::$table .".eng, "
            . self::$table .".status, "
            . Flashcard::$table . '.name as flashcard_name'
            . " FROM " . self::$table
            . " LEFT JOIN " . Flashcard::$table
            . " ON " . self::$table . ".flashcard_id" . " = " . Flashcard::$table . '.id')->fetchAll();

        return $data;
    }
}