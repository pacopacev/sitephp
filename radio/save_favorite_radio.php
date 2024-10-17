<?php

require('../mysql_conn.php');

if (isset($_POST['name']) && isset($_POST['url']) && isset($_POST['stationuuid'])) {
    if (checkIfExistInFavorites($conn, $_POST['stationuuid']) == true) {
        header('Content-type: application/json');
        echo json_encode(['success' => false]);
        exit();
    }
    $name = json_encode($_POST['name']);
    $url = json_encode($_POST['url']);
    $stationuuid = json_encode($_POST['stationuuid']);
    $updated_at = null;
    mysqli_query($conn, "INSERT INTO `favorite_radios`"
                    . "(name, url, stationuuid, created_at, updated_at)"
                    . "VALUES('$name','$url', '$stationuuid', now(), '$updated_at')") or die('query failed');
    header('Content-type: application/json');
    echo json_encode(['success' => true, 'name_radio' => $name]);
    exit();
}

function checkIfExistInFavorites($conn, $stationuuid) {
    $stationuuid = "%" . $stationuuid . "%";
    $fetch_query = mysqli_query($conn, "SELECT * FROM `favorite_radios` WHERE `stationuuid` LIKE '$stationuuid'  ");
    $row = mysqli_num_rows($fetch_query);
    if ($row > 0) {
        return true;
    }
}
