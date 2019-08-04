<?php

namespace Controllers;

use App\Models\Block;

class ProfileController extends Controller
{
    public function get()
    {
        $blocks = Block::read();

        view('profile', ['blocks' => $blocks]);
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