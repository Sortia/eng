<?php

namespace Controllers;

use App\Models\Flashcard;

class ProfileController extends Controller
{
    public function get()
    {
        $flashcards = Flashcard::read();

        view('profile', ['flashcards' => $flashcards]);
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