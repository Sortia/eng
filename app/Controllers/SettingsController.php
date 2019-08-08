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
}