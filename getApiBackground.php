<?php

//require 'mysql_conn.php';

class getApiBackground {

    public function getApiPics() {
        include("mysql_conn.php");
        $api_background_sql = "SELECT * FROM `api_background` ORDER BY id DESC LIMIT 1";
        return $result = $conn->query($api_background_sql);
    }
}
