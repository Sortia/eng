<?php
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