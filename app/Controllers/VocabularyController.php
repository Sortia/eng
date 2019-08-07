<?php

namespace Controllers;

use App\Models\Flashcard;
use App\Models\Item;

class VocabularyController extends Controller
{
    public function get()
    {
        $items = Item::withFlashcard();
        $flashcards = Flashcard::read();

        return view('vocabulary', ['items' => $items, 'flashcards' => $flashcards]);
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