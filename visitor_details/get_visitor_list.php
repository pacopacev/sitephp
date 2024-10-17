<?php

require('../conn/mysql_conn_phplogin.php');
$fetch_query = mysqli_query($connection_if0_36973486_phplogin, "SELECT * FROM `visitor_details` ORDER BY id DESC");

$row = mysqli_num_rows($fetch_query);
if ($row > 0) {

    $data = array();
    while ($res = mysqli_fetch_array($fetch_query)) {
        $res_array = array();
        $res_array[] = $res['id'];
        $res_array[] = $res['HTTP_USER_AGENT'];
        $res_array[] = $res['REMOTE_ADDR'];
        $res_array[] = $res['SCRIPT_NAME'];
        $res_array[] = $res['QUERY_STRING'];
        $res_array[] = $res['current_page'];
        $res_array[] = $res['date'];
        $res_array[] = $res['time'];
        $res_array[] = $res['country'];
        $res_array[] = $res['city'];
        $res_array[] = $res['region'];
        $res_array[] = $res['latitude'];
        $res_array[] = $res['longitude'];
        $res_array[] = $res['time_zone'];
        $res_array[] = $res['provider'];

        $data[] = $res_array;
    }
} else {
    $data = array();
    $res_array[] = '';
    $res_array[] = '';
    $res_array[] = '';
    $res_array[] = '';
    $res_array[] = '';
    $res_array[] = '';
    $res_array[] = '';
    $res_array[] = '';
    $res_array[] = '';
    $res_array[] = '';
    $res_array[] = '';
    $res_array[] = '';
    $res_array[] = '';
    $res_array[] = '';
    $res_array[] = '';
    $data[] = $res_array;
}


echo json_encode($data);

