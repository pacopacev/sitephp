<?php
include("mysql_conn.php");
echo $_GET['id'];
mysqli_query($conn, "DELETE FROM `api_background` WHERE `api_background`.`id` = ".$_GET['id'].""); 



