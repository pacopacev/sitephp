<?php
include('../mysql_conn.php');
$fetch_query = mysqli_query($conn, "SELECT * FROM `api_background` ORDER BY id ASC");


$row = mysqli_num_rows($fetch_query);
if ($row > 0) {
   
    $data = array();
    while ($res = mysqli_fetch_array($fetch_query)) {
        $res_array = array();
        $res_array[] = $res['id'];
        $res_array[] = $res['key_word_1'];
        $res_array[] = $res['key_word_2'];
        $res_array[] = '';
        $data[] = $res_array;
    }
} else {
    $data = array();
    $res_array[] = '';
    $res_array[] = '';
    $res_array[] = '';
    $res_array[] = '';
    $data[] = $res_array;
}
 

echo json_encode($data);
