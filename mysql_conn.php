<?php

$database = 'if0_36973486_test';
$user = 'if0_36973486';
$pass = '1GdNvDWSnlI';
$host = 'sql203.infinityfree.com';

$conn = mysqli_connect($host, $user, $pass, $database) or die('connection failed');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

