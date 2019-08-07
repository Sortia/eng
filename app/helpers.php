<?php

use Jenssegers\Blade\Blade;

/**
 * dump variable and die
 *
 * @param mixed ...$vars
 */
function dd(...$vars)
{
    echo '<pre>';

    foreach ($vars as $var)
        print_r($var);

    exit;
}

/**
 * dump variable
 *
 * @param mixed ...$vars
 */
function d(...$vars)
{
    echo '<pre>';

    foreach ($vars as $var)
        print_r($var);
}

/**
 * @param array $data
 * @param int $status
 */
function response($data = [], $status = 200)
{
    if ($status !== 200) {
        header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        header('Status: ' . $status);
    }

    echo json_encode($data);
}

function view($template, $data = [])
{
    $blade = new Blade(ROOT . '/app/Views', ROOT . '/public/cache');

    echo $blade->make($template, $data);
}

/**
 * @return bool
 */
function auth() : bool
{
    return \App\Models\Auth::isAuth();
}