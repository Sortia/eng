<?php


namespace Controllers;

use Jenssegers\Blade\Blade;

class BlockController extends Controller
{
    public function get()
    {
        $query = "SELECT * FROM block;";
        $blocks = mysqli_fetch_all(mysqli_query($this->link, $query));
        $blade = new Blade(ROOT . '/app/Views', ROOT . '/public/cache');

        echo $blade->make('blocks', ['blocks' => $blocks]);
    }

    public function postSave()
    {
        $block_name = $_REQUEST['block_name'];
        $query = "INSERT INTO block (name, status) VALUES ('$block_name', 0);";

        mysqli_query($this->link, $query);
    }

    public function postUpdate()
    {
        $status = $_REQUEST['status'] === "true" ? 1 : 0;
        $block_id = $_REQUEST['block_id'];

        $query = "UPDATE item SET status = '$status' WHERE block_id = '$block_id';";
        mysqli_query($this->link, $query);
        $query = "UPDATE block SET status = '$status' WHERE id = '$block_id';";
        mysqli_query($this->link, $query);
    }

    public function postDelete()
    {
        $block_name = $_REQUEST['del_block'];

        $query = "SELECT id FROM block WHERE name = $block_name";
        $id = mysqli_fetch_all(mysqli_query($this->link, $query))[0][0];
        $query = "DELETE FROM block WHERE name = '$block_name';";
        mysqli_query($this->link, $query);
        $query = "DELETE FROM item WHERE block_id = '$id';";
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