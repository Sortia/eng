<?php require_once 'sup_functions.php';
// TODO valid name_block (no repeat)

$link = mysqli_connect("127.0.0.1", "root", "", "eng");
$query = "";

if (isset($_GET['status']) AND isset($_GET['block_id'])) {

    $status = $_GET['status'] === "true" ? 1 : 0;
    $block_id = $_GET['block_id'];

    $query = "UPDATE item SET status = '$status' WHERE block_id = '$block_id';";
    mysqli_query($link, $query);
    $query = "UPDATE block SET status = '$status' WHERE id = '$block_id';";
    mysqli_query($link, $query);
}

if (isset($_GET['block_name'])) {

    $block_name = $_GET['block_name'];
    $query = "INSERT INTO block (name, status) VALUES ('$block_name', 0);";

    mysqli_query($link, $query);
}

if (isset($_GET['del_block'])) {
    $block_name = $_GET['del_block'];

    $query = "SELECT id FROM block WHERE name = $block_name";
    $id = mysqli_fetch_all(mysqli_query($link, $query))[0][0];
    $query = "DELETE FROM block WHERE name = '$block_name';";
    mysqli_query($link, $query);
    $query = "DELETE FROM item WHERE block_id = '$id';";
    mysqli_query($link, $query);
}

mysqli_close($link);