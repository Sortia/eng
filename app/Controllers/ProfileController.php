<?php

namespace Controllers;

use App\Models\Auth;
use App\Models\Flashcard;

class ProfileController extends Controller
{
    public function get()
    {
        $user = AuthController::user();

        $flashcards = Flashcard::read();

        view('profile', ['user' => $user, 'flashcards' => $flashcards]);
    }

    public function postUpdate()
    {
        // prepare image
        if (!empty($this->files['img']['name'])) {
            $img_name = mt_rand(0, 1000000) . $this->files['img']['name'];
            copy($this->files['img']['tmp_name'], ROOT . '/public/img/' . $img_name);

            $this->request['img'] = $img_name;
        }

        // prepare password
        if (!empty($this->request['old_password']) AND !empty($this->request['new_password'])) {

            $user = Auth::getAuthUser();

            if (empty($user))
                view('login');

            if (password_verify($this->request['old_password'], $user['password'])) {
                $password_hash = password_hash($this->request['new_password'], PASSWORD_DEFAULT);
                $this->request['password'] = $password_hash;
                $this->session['password'] = $this->request['new_password'];
            }
        }

        $this->session['login'] = $this->request['login'];

        Auth::update($this->request);

        header('Location: /profile');
    }
}