<?php

namespace Controllers;

abstract class Controller
{
    abstract public function postCreate();

    abstract public function postUpdate();

    abstract public function postDelete();
}