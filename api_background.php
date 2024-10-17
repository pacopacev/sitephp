<?php
include 'mysql_conn.php';
include 'getApiBackground.php';
$demo =  new getApiBackground();
$result = $demo->getApiPics();

if ($result->num_rows > 0) {

    foreach ($result as $elem) {

        $word_1 = $elem['key_word_1'];
        $word_2 = $elem['key_word_2'];
    }
}


$pics = [];
//$word_1 = 'mountain';
//$word_2 = 'mountain';
$slides = @file_get_contents("https://pixabay.com/api/?key=44204412-f20354ab47543c01dc09c16fb&q=" . $word_1 . "+" . $word_2 . "&image_type=photo", true);
foreach (json_decode($slides, true) as $k => $v) {
    if (is_array($v)) {
        foreach ($v as $kk => $vv) {
            if (!isset($vv['webformatURL'])) {
                continue;
            }
            $pics[$kk] = $vv['webformatURL'];
        }
    }
}
if (!count($pics)) {
    $pics[0] = "frontend/images/signin-image.jpg"; //
}

$api_background_combo = "SELECT * FROM `api_background` ORDER BY id ASC";
$api_background_combo_result = $conn->query($api_background_combo);




