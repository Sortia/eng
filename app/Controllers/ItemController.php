<?php

namespace Controllers;

class ItemController extends Controller
{
    public function post()
    {
        $block_id = $_REQUEST['block_id'];
        $query = "SELECT * FROM item WHERE block_id = $block_id";
        $items = mysqli_fetch_all(mysqli_query($this->link, $query));

        response($items);
    }

    public function postDelete()
    {
        $rus = $_REQUEST['del_rus'];
        $eng = $_REQUEST['del_eng'];

        $query = "DELETE FROM item WHERE rus = '$rus' AND eng = '$eng';";

        mysqli_query($this->link, $query);
    }

    public function postUpdate()
    {
        $status = $_REQUEST['status'] === "true" ? 1 : 0;
        $item_id = $_REQUEST['item_id'];

        $query = "UPDATE item SET status = '$status' WHERE id = '$item_id'";

        mysqli_query($this->link, $query);
    }

    public function postCreate()
    {
        $rus = $_REQUEST['rus'];
        $eng = $_REQUEST['eng'];
        $block_id = $_REQUEST['parent'];

        $query = "INSERT INTO item (rus, eng, block_id) VALUES ('$rus', '$eng', '$block_id');";

        mysqli_query($this->link, $query);
    }

    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        parent::__destruct();
    }
}