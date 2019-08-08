<?php

namespace App\Models;

class Auth extends Model
{
    static public string $table = 'users';

    static public array $fill = [
        'id',
        'first_name',
        'last_name',
        'img',
        'login',
        'password',
        'email'
    ];

    static public function read($param = null): array
    {
        return self::$link->query("SELECT * FROM " . static::$table . " ORDER BY id desc;")->fetchAll();
    }

    static public function isAuth(): bool
    {
        $user = self::getAuthUser();

        if (!empty($user))
            return password_verify($_SESSION['password'], $user['password']);
        else return false;
    }

    static public function getAuthUser(): array
    {
        if (isset($_SESSION['login']) AND isset($_SESSION['password'])) {
            $login = $_SESSION['login'];
            $password = $_SESSION['password'];

            $user = self::$link->query("SELECT * FROM " . self::$table . " WHERE login = '$login' LIMIT 1;");
            $user = self::fetch($user);

            if (!empty($user) && password_verify($password, $user[0]['password']))
                return $user[0];
        }

        return [];
    }
}