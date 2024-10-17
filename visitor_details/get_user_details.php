<?php

require('conn/mysql_conn_phplogin.php');
require("PHPMailer-master/src/PHPMailer.php");
require("PHPMailer-master/src/SMTP.php");
require("PHPMailer-master/src/Exception.php");

// get user details
$user_agent = $_SERVER['HTTP_USER_AGENT']; //user browser
$ip_address = $_SERVER["REMOTE_ADDR"];     // user ip adderss
$page_name = $_SERVER["SCRIPT_NAME"];      // page the user looking
$query_string = $_SERVER["QUERY_STRING"];   // what query he used
$current_page = $page_name . "?" . $query_string;
// get location 
$api_key = '776E2A94BF27BFC7A215805D50F27C7E';
$url = json_decode(file_get_contents("https://api.ip2location.io/?key=" . $api_key . "&ip=" . $_SERVER['REMOTE_ADDR'] . "&format=json"));
//get time

date_default_timezone_set('UTC');
$date = date("Y-m-d");
$time = date("H:i:s");

if (isset($_SERVER)) {
    $tmp = (array) $url;
    if (!empty($tmp)) {
        $country = $url->country_name;
        $city = $url->city_name;
        $region = $url->region_name;
        $latitude = $url->latitude;
        $longitude = $url->longitude;
        $timeZone = $url->time_zone;
        $provider = $url->as;
    }
    if($ip_address != '130.185.221.98'){
    mysqli_query($connection_if0_36973486_phplogin, "INSERT INTO `visitor_details`"
                    . "(HTTP_USER_AGENT, REMOTE_ADDR, SCRIPT_NAME, QUERY_STRING, current_page, date, time, country, city, region, latitude, longitude, time_zone, provider) "
                    . "VALUES('$user_agent','$ip_address', '$page_name', '$query_string', '$current_page','$date', '$time', '$country','$city', '$region', '$latitude', '$longitude', '$timeZone', '$provider')") or die('query failed');
    sendMailAboutVisitor($connection_if0_36973486_phplogin);
    }  
}

function countVisitors($connection_if0_36973486_phplogin) {

    $numberOfVisitors = mysqli_query($connection_if0_36973486_phplogin, "SELECT MAX(id) as number_of_visitors FROM `visitor_details` WHERE REMOTE_ADDR is not null");
    if (!empty($numberOfVisitors)) {
        while ($row = mysqli_fetch_assoc($numberOfVisitors)) {
            $total_number_of_visitors = $row['number_of_visitors'];
            return $total_number_of_visitors;
        }
    }

    return $total_number_of_visitors = 'first one';
}

function getVisitorInfo($connection_if0_36973486_phplogin) {
    $visitorInfo = mysqli_query($connection_if0_36973486_phplogin, "SELECT * FROM `visitor_details` WHERE id = (SELECT MAX(id) FROM `visitor_details`)");
    if (!empty($visitorInfo)) {
        while ($row = mysqli_fetch_assoc($visitorInfo)) {
            return $row;
        }
    }
    return;
}

function tooltipVisitors($connection_if0_36973486_phplogin) {
    $visitorInfo = getVisitorInfo($connection_if0_36973486_phplogin);
//    print_r($visitorInfo);
//    exit;
    if (count($visitorInfo)) {
        $tooltipVisitors = 
                  $visitorInfo['HTTP_USER_AGENT'] . "\n" . "; "
                . $visitorInfo['REMOTE_ADDR'] . "\n". "; "
                . $visitorInfo['date'] . "\n" . "; "
                . $visitorInfo['time'] . "\n". "; "
                . $visitorInfo['country'] . "\n" . "; "
                . $visitorInfo['city'] . "\n". "; "
                . $visitorInfo['latitude'] . "\n" . ", "
                . $visitorInfo['longitude'] . "\n". "; "
                . $visitorInfo['provider'] . "\n";
        return $tooltipVisitors;
    }
    return;
}

function sendMailAboutVisitor($connection_if0_36973486_phplogin) {
    $visitorInfo = getVisitorInfo($connection_if0_36973486_phplogin);
    //print_r($visitorInfo);
    //exit;
    $yahoo_mail = new PHPMailer\PHPMailer\PHPMailer();
    $yahoo_mail->IsSMTP();
    $yahoo_mail->SMTPDebug = false;
// Send email using Yahoo SMTP server
    $yahoo_mail->Host = 'smtp.mail.yahoo.com';
// port for Send email
    $yahoo_mail->Port = 465;
    $yahoo_mail->SMTPSecure = 'ssl';
    //$yahoo_mail->SMTPDebug = 2;
    $yahoo_mail->SMTPAuth = true;
    $yahoo_mail->Username = 'pgdimitrov@yahoo.com';
    $yahoo_mail->Password = 'mcmmpcprkpviwgpi';

    $yahoo_mail->From = 'pgdimitrov@yahoo.com';
    $yahoo_mail->FromName = 'plambe.wuaze.com'; // frome name
    $yahoo_mail->AddAddress('pgdimitrov@yahoo.com', 'pgdimitrov@yahoo.com');  // Add a recipient  to name
    //$yahoo_mail->AddAddress('pgdimitrov@yahoo.com');  // Name is optional

    $yahoo_mail->IsHTML(true); // Set email format to HTML

    $yahoo_mail->Subject = 'Check visitor';
    $yahoo_mail->Body = tooltipVisitors($connection_if0_36973486_phplogin);
    //$yahoo_mail->AltBody = 'This is the body in plain text for non-HTML mail clients at https://onlinecode.org/';

    if (!$yahoo_mail->Send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $yahoo_mail->ErrorInfo;
        exit;
    } else {
        //echo 'Message of Send email using Yahoo SMTP server has been sent';
    }
}
