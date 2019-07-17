<?php

namespace Controllers;

use App\Models\Item;

class ItemController extends Controller
{
    public function post()
    {
        $block_id = $_REQUEST['block_id'];

        $items = Item::read($block_id);

        response($items);
    }

    public function postCreate()
    {
        $rus = $_REQUEST['rus'];
        $eng = $_REQUEST['eng'];
        $block_id = $_REQUEST['parent'];

        Item::create($rus, $eng, $block_id);
    }

    public function postUpdate()
    {
        $status = $_REQUEST['status'] === "true" ? 1 : 0;
        $item_id = $_REQUEST['item_id'];

        Item::update($status, $item_id);
    }

    public function postDelete()
    {
        $rus = $_REQUEST['del_rus'];
        $eng = $_REQUEST['del_eng'];

        Item::delete($rus, $eng);
    }
}