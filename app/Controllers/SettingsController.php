<?php

namespace Controllers;

use App\Models\Flashcard;

class SettingsController extends Controller
{
    public function get()
    {
        $flashcards = Flashcard::read();

        view('settings', ['flashcards' => $flashcards]);
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