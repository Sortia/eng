<?php
require_once 'sup_functions.php';

$link = mysqli_connect("127.0.0.1", "root", "", "eng");
$query = "";

if (isset($_GET['status']) AND isset($_GET['block_id'])) {

    $status = $_GET['status'] === "true" ? 1 : 0;
    $block_id = $_GET['block_id'];


    $query = "UPDATE item SET status = '$status' WHERE block_id = '$block_id';";
    mysqli_query($link, $query);
    $query = "UPDATE block SET status = '$status' WHERE id = '$block_id';";
    mysqli_query($link, $query);

//    dd($query);
}


mysqli_close($link);