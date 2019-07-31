<?php

namespace Controllers;

use App\Models\Block;
use App\Models\Item;

class VocabularyController extends Controller
{
    public function get()
    {
        $items = Item::withBlock();
        $blocks = Block::read();

        return view('vocabulary', ['items' => $items, 'blocks' => $blocks]);
    }

    public function postCreate()
    {
        // TODO: Implement postCreate() method.
    }

    public function postUpdate()
    {
        // TODO: Implement postUpdate() method.
    }

    public function postDelete()
    {
        // TODO: Implement postDelete() method.
    }
}