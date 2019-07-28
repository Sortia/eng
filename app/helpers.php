<?php

use Jenssegers\Blade\Blade;

/**
 * Created by PhpStorm.
 * User: Яяя
 * Date: 19.01.2019
 * Time: 13:32
 * @param string $var1
 * @param string $var2
 * @param string $var3
 */

function dd($var1 = "not_found", $var2 = "not_found", $var3 = "not_found")
{
    echo '<pre>';
    if ($var1 !== "not_found") print_r($var1);
    echo "<br>";
    if ($var2 !== "not_found") print_r($var2);
    echo "<br>";
    if ($var3 !== "not_found") print_r($var3);
    echo "<br>";
    echo '<pre>';

    exit;
}

function d($var1 = "not_found", $var2 = "not_found", $var3 = "not_found")
{
    echo '<pre>';
    if ($var1 !== "not_found") var_dump($var1);
    echo "<br>";
    if ($var2 !== "not_found") var_dump($var2);
    echo "<br>";
    if ($var3 !== "not_found") print_r($var3);
    echo "<br>";
    echo '<pre>';
}

function asset($path)
{
    return ROOT . '/' . $path;
}

function response($data = true, $status = 200)
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

function auth()
{
    return \App\Models\Auth::isAuth();
}

function array_unset_val(&$array, $key)
{
    if (isset($array[$key])) {
        $val = $array[$key];

        unset($array[$key]);

        return $val;
    } else {
        return null;
    }
}