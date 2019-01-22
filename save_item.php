<?php require_once 'sup_functions.php';
// TODO valid rus/eng (no repeat)
// TODO save data in cloud
$link = mysqli_connect("127.0.0.1", "root", "", "eng");
$query = "";

if (isset($_GET['rus']) AND isset($_GET['eng'])) {

    $rus = $_GET['rus'];
    $eng = $_GET['eng'];
    $block_id = $_GET['parent'];

    $query = "INSERT INTO item (rus, eng, block_id) VALUES ('$rus', '$eng', '$block_id');";
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

if (isset($_GET['block_id'])) {

    $block_id = $_GET['block_id'];
    $query = "SELECT * FROM item WHERE block_id = $block_id";
    $items = mysqli_fetch_all(mysqli_query($link, $query));
    $query = '';

    echo json_encode($items);
}

if($query !== '')
    mysqli_query($link, $query);

mysqli_close($link);
