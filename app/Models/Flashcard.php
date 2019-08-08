<?php

namespace App\Models;

class Flashcard extends Model
{
    static public string $table = 'flashcards';

    static public array $fill = [
        'id',
        'name',
        'status',
        'user_id'
    ];

    static public function read($user_id = null) : array
    {
        $user = Auth::getAuthUser();

        if (empty($user))
            view('login');

       return self::$link->query("SELECT * FROM " . static::$table . " WHERE user_id = {$user['id']} ORDER BY id desc;")->fetchAll();
    }
}