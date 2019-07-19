<?php

namespace App\Models;

class Block extends Model
{
    static public function create($block_name)
    {
        $query = "INSERT INTO block (name, status) VALUES ('$block_name', 0);";

        mysqli_query(self::$link, $query);
    }

    static public function read()
    {
        $query = "SELECT * FROM block ORDER BY id desc;";

        $blocks = mysqli_fetch_all(mysqli_query(self::$link, $query));

        return $blocks;
    }

    static public function update($status, $block_id)
    {
        $query = "UPDATE item SET status = '$status' WHERE block_id = '$block_id';";
        mysqli_query(self::$link, $query);
        $query = "UPDATE block SET status = '$status' WHERE id = '$block_id';";
        mysqli_query(self::$link, $query);
    }

    static public function delete($block_name)
    {
        $query = "SELECT id FROM block WHERE name = $block_name";
        $id = mysqli_fetch_all(mysqli_query(self::$link, $query))[0][0];
        $query = "DELETE FROM block WHERE name = '$block_name';";
        mysqli_query(self::$link, $query);
        $query = "DELETE FROM item WHERE block_id = '$id';";
        mysqli_query(self::$link, $query);
    }
}