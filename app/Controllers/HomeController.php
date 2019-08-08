<?php

namespace Controllers;

use App\Models\Flashcard;

class HomeController extends Controller
{
    public function get()
    {
        $flashcards = Flashcard::read();

        view('home', ['flashcards' => $flashcards]);
    }
}