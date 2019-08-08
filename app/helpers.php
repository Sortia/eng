<?php

use Jenssegers\Blade\Blade;
use App\Models\Auth;

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
function response(array $data = [], int $status = 200)
{
    if ($status !== 200) {
        header('HTTP/1.1 500 Internal Server Booboo');
        header('Content-Type: application/json; charset=UTF-8');
        header('Status: ' . $status);
    }

    echo json_encode($data);
}

function view(string $template, array $data = [])
{
    $blade = new Blade(ROOT . '/app/Views', ROOT . '/public/cache');

    echo (string)$blade->make($template, $data);
    exit;
}

function auth(): bool
{
    return Auth::isAuth();
}

function asset(string $path): string
{
    return '../../public/' . $path;
}