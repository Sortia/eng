<?php

namespace Controllers;

use App\Models\Flashcard;
use App\Models\Item;

class ItemController extends Controller
{
    public function get(int $flashcard_id)
    {
        $items = Item::read($flashcard_id);

        $flashcards = Flashcard::read();

        view('items' , ['items' => $items, 'flashcards' => $flashcards]);
    }

    public function postCreate()
    {
        $item = Item::create($this->request);

        response($item);
    }

    public function postUpdate()
    {
        $this->request['status'] = $this->request['status'] === "true" ? 1 : 0;

        $item = Item::update($this->request);

        response($item);
    }

    public function postDelete()
    {
        $item_id = $this->request['item_id'];

        $success =  Item::delete($item_id);

        $success ? response() : response([], 500);
    }
}