<?php

namespace App\Models;

class Auth extends Model
{
    static public string $table = 'users';

    static public function isAuth()
    {
        if(isset($_SESSION['login']) AND $_SESSION['password']) {
            $login = $_SESSION['login'];
            $password = $_SESSION['password'];

            $user = self::$link->query("SELECT * FROM " . self::$table . " WHERE login = '$login' LIMIT 1;")->fetchAll();

            return password_verify($password, $user[0]['password']);
        }

        return false;
    }
}