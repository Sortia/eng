<?php

namespace Controllers;

use App\Models\Item;

class ItemController extends Controller
{
    public function post()
    {
        $block_id = $this->request['block_id'];

        $items = Item::read($block_id);

        response($items);
    }

    public function postCreate()
    {
        $rus = $this->request['rus'];
        $eng = $this->request['eng'];
        $block_id = $this->request['parent'];

        $item = Item::create($rus, $eng, $block_id);

        response($item);
    }

    public function postUpdate()
    {
        $this->request['status'] = $this->request['status'] === "true" ? 1 : 0;

        unset($this->request['path']);

        $item = Item::update($this->request);

        response($item);
    }

    public function postDelete()
    {
        $item_id = $this->request['item_id'];

        $success =  Item::delete($item_id);

        $success ? response() : response(false, 500);
    }
}