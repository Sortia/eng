<?php

namespace App\Models;

//session_start();

class Auth extends Model
{
    static public $table = 'users';

    static public function create($user)
    {
        self::$link->query("INSERT INTO " . self::$table . " (login, password, email) VALUES ('{$user['login']}', '{$user['password']}', '{$user['email']}');");

        return self::$link->query("SELECT * FROM " . self::$table . " WHERE id = (" . self::$link->lastInsertId() . ")")->fetch();
    }

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