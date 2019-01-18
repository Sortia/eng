<?php

$link = mysqli_connect("127.0.0.1", "root", "", "eng");
$query = "";

if (isset($_GET['rus']) AND isset($_GET['eng'])) {

    $rus = $_GET['rus'];
    $eng = $_GET['eng'];

    $query = "INSERT INTO item (rus, eng) VALUES ('$rus', '$eng');";
}

if (isset($_GET['del_rus']) AND isset($_GET['del_eng'])) {

    $rus = $_GET['del_rus'];
    $eng = $_GET['del_eng'];

    $query = "DELETE FROM item WHERE rus = '$rus' AND eng = '$eng';";
}

if (isset($_GET['status']) AND isset($_GET['item_id'])) {

    $status = $_GET['status'] === "true" ? 1 : 0;
    $item_id = $_GET['item_id'];

    $query = "UPDATE item SET status = '$status' WHERE id = '$item_id'";
}

if($query !== '')
    mysqli_query($link, $query);

mysqli_close($link);
