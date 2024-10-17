<?php
include('../mysql_conn.php');
if (isset($_POST['key_word_1']) && $_POST['key_word_2']) {

    $key_word_1 = mysqli_real_escape_string($conn, $_POST['key_word_1']);
    $key_word_2 = mysqli_real_escape_string($conn, $_POST['key_word_2']);

    $insert = mysqli_query($conn, "INSERT INTO `api_background`(key_word_1, key_word_2) VALUES('$key_word_1','$key_word_2')") or die('query failed');
}
