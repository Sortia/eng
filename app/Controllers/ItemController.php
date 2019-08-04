<?php

namespace Controllers;

use App\Models\Item;

class ItemController extends Controller
{
    public function post()
    {
        $flashcard_id = $this->request['flashcard_id'];

        $items = Item::read($flashcard_id);

        response($items);
    }

    public function postCreate()
    {
        $item = Item::create($this->request);

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