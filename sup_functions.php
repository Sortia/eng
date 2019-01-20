<?php
/**
 * Created by PhpStorm.
 * User: Яяя
 * Date: 19.01.2019
 * Time: 13:32
 */

// todo rewrite as class

/* @param $db_array
 * @param $table
 * @return array
 */

// todo send here sql query and return array

function link_up($db_array, $table)
{

    $db_config = [
        'items' => [
            0 => 'id',
            1 => 'rus',
            2 => 'eng',
            3 => 'status',
            4 => 'block_id',
        ],
        'blocks' => [
            0 => 'id',
            1 => 'name',
            2 => 'status',
        ]
    ];

    $db_data = mysqli_fetch_all($db_array);
    $rez_data = [];
    $record = [];

    for ($i = 0; $i < count($db_data); $i++) {
        for ($j = 0; $j < count($db_data[$i]); $j++)
            $record[$db_config[$table][$j]] = $db_data[$i][$j];
        $rez_data[] = $record;
    }

    return $rez_data;
}

function group_by($array, $name_field = 'block_id')
{
    $keys = [];
    $rez_arr = [];

    foreach ($array as $value)
        if (!in_array($value[$name_field], $keys))
            $keys[] = $value[$name_field];

    foreach ($keys as $key) {
        $cur_arr = [];
        foreach ($array as $item) {
            if ($key == $item[$name_field]) {
                $cur_arr[] = $item;
            }
        }
        $rez_arr[] = $cur_arr;
    }

    return $rez_arr;
}


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