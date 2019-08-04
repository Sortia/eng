<?php

namespace Controllers;

use App\Models\Block;

class SettingsController extends Controller
{
    public function get()
    {
        $blocks = Block::read();

        view('settings', ['blocks' => $blocks]);
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