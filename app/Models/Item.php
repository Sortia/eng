<?php

namespace App\Models;

class Item extends Model
{
    static public function create($rus, $eng, $block_id)
    {
        $query = "INSERT INTO item (rus, eng, block_id) VALUES ('$rus', '$eng', '$block_id');";

        mysqli_query(self::$link, $query);
    }

    static public function read($block_id)
    {
        $query = "SELECT * FROM item WHERE block_id = $block_id";
        $items = mysqli_fetch_all(mysqli_query(self::$link, $query));

        return $items;
    }

    static public function update($status, $item_id)
    {
        $query = "UPDATE item SET status = '$status' WHERE id = '$item_id'";

        mysqli_query(self::$link, $query);
    }

    static public function delete($rus, $eng)
    {
        $query = "DELETE FROM item WHERE rus = '$rus' AND eng = '$eng';";

        mysqli_query(self::$link, $query);
    }
}