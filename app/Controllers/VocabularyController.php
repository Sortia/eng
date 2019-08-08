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

        view('vocabulary', ['items' => $items, 'flashcards' => $flashcards]);
    }
}