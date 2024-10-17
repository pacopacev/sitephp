<?php

require('../mysql_conn.php');

if (isset($_POST['id']) && isset($_POST['name'])) {
    $id = json_encode($_POST['id']);
    $name = json_encode($_POST['name']);
    delFavorite($conn, $id, $name);
}

function delFavorite($conn, $id, $name) {
    mysqli_query($conn, "DELETE FROM `favorite_radios` WHERE id = $id") or die('query failed');
    header('Content-type: application/json');
    echo json_encode(['success' => true, 'name_radio' => $name]);
    exit();
}
