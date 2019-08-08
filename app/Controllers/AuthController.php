<?php

namespace Controllers;

session_start();

use App\Models\Auth;

class AuthController extends Controller
{
    private string $login;
    private string $password;

    public function __construct()
    {
        parent::__construct();

        if(isset($this->request['login']) AND $this->request['password']) {
            $this->login = $this->request['login'];
            $this->password = $this->request['password'];
        }
    }

    public function getLogin()
    {
        view('login');
    }

    public function getRegister()
    {
        view('registration');
    }

    public function getLogout()
    {
        session_destroy();
        header("Location: /auth/login");
    }

    public function postLogin()
    {
        $this->auth();
        header("Location: /");
    }

    public function postCreate()
    {
        $this->request['password'] = password_hash($this->request['password'], PASSWORD_DEFAULT);

        unset($this->request['path']);

        Auth::create($this->request);

        $this->auth();

        header("Location: /");
    }

    private function auth()
    {
        $this->session['login'] = $this->login;
        $this->session['password'] = $this->password;
    }

    static public function user()
    {
        $user = Auth::getAuthUser();

        if (empty($user))
            view('login');
        else return $user;
    }
}