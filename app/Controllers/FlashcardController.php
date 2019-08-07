<?php

namespace Controllers;

use App\Models\Flashcard;

class FlashcardController extends Controller
{
    public function get()
    {
        $flashcards = Flashcard::read();

        view('flashcards', ['flashcards' => $flashcards]);
    }

    public function postCreate()
    {
        $flashcard = Flashcard::create($this->request);

        response($flashcard);
    }

    public function postUpdate()
    {
        $this->request['status'] = $this->request['status'] === "true" ? 1 : 0;

        unset($this->request['path']);

        $flashcard = Flashcard::update($this->request);

        response($flashcard);
    }

    public function postDelete()
    {
        $flashcard_id = $this->request['flashcard_id'];

        $flashcard = Flashcard::delete($flashcard_id);

        response($flashcard);
    }

    public function getFlashcard()
    {
        dd($this->request);
    }
}