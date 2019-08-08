<?php

namespace App\Models;

class Flashcard extends Model
{
    static public string $table = 'flashcards';

    static public array $fill = [
        'id',
        'name',
        'status'
    ];
}