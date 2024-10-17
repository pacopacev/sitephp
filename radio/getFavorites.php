<?php

require('../mysql_conn.php');
$fetch_query = mysqli_query($conn, "SELECT * FROM `favorite_radios` ORDER BY id DESC");
$row = mysqli_num_rows($fetch_query);
if ($row > 0) {
    $data = array();
    while ($res = mysqli_fetch_array($fetch_query)) {
        $res_array = array();
        $res_array['id'] = $res['id'];
        $res_array['name'] = $res['name'];
        $res_array['url'] = $res['url'];


        $data[] = $res_array;
    }
    echo json_encode($data);
} else {
    $data = array();
    $res_array[] = '';
    $data[] = $res_array;
    echo json_encode($data);
}

