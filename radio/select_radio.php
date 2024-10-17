<?php

include_once '../vendor/autoload.php';
//use Unirest;
//https://github.com/adinan-cenci/radio-browser/blob/master/src/RadioBrowserApi.php
//https://de1.api.radio-browser.info/json/stations/bytag/black_metal?limit=10000&hidebroken=true

if (isset($_POST['genre']) && !isset($_POST['country'])) {
    getGenre($_POST['genre']);
}
if (!isset($_POST['genre']) && isset($_POST['country'])) {
    getCountry($_POST['country']);
}
if (isset($_POST['genre']) && isset($_POST['country'])) {

    if ($_POST['genre'] != "none" && $_POST['country'] == "none") {
        getGenre($_POST['genre']);
        return;
    }
    if ($_POST['genre'] == "none" && $_POST['country'] != "none") {
        getCountry($_POST['country']);
        return;
    }

    getGenreCountry($_POST['genre'], $_POST['country']);
}

function getGenre($genre) {
    $headers = array('Accept' => 'application/json');
    $response = Unirest\Request::get("http://65.109.136.86/json/stations/bytag/" . $genre . "?limit=10000&hidebroken=true", $headers);

//    $curl = curl_init();
//
//curl_setopt_array($curl, array(
//  CURLOPT_URL => "http://65.109.136.86/json/stations/bytag/black_metal?limit=10000&hidebroken=true",
//  CURLOPT_RETURNTRANSFER => true,
//  CURLOPT_TIMEOUT => 30,
//  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//  CURLOPT_CUSTOMREQUEST => "GET",
//  CURLOPT_HTTPHEADER => array(
//    "cache-control: no-cache"
//  ),
//));
//
//$response = curl_exec($curl);
//$err = curl_error($curl);
//echo $err;
//    
//   curl_close($curl); 
//    
//    $response = json_decode($response, true);
//    print_r($response);
//exit;    

    if ($response->code == 200) {
        $data = array();
        foreach ($response->body as $v) {
            $res_array = array();
            $res_array['name'] = $v->name;
            $res_array['url'] = $v->url;
            $res_array['bitrate'] = $v->bitrate;
            $res_array['codec'] = $v->codec;
            $res_array['countrycode'] = $v->countrycode;
            $res_array['stationuuid'] = $v->stationuuid;
            $data[] = $res_array;
        }
        echo json_encode($data);
    } else {
        echo "Error: " . $response->code . " - " . $response->statusText;
    }
}

function getCountry($country) {
    $headers = array('Accept' => 'application/json');
    $response = Unirest\Request::get("http://65.109.136.86/json/stations/bycountrycodeexact/" . $country . "?limit=10000&hidebroken=true", $headers);
    if ($response->code == 200) {
        $data = array();
        foreach ($response->body as $v) {
            $res_array = array();
            $res_array['name'] = $v->name;
            $res_array['url'] = $v->url;
            $res_array['bitrate'] = $v->bitrate;
            $res_array['codec'] = $v->codec;
            $res_array['countrycode'] = $v->countrycode;
            $res_array['stationuuid'] = $v->stationuuid;
            $data[] = $res_array;
        }
        echo json_encode($data);
    } else {
        echo "Error: " . $response->code . " - " . $response->statusText;
    }
}

function getGenreCountry($genre, $country) {
$headers = array('Accept' => 'application/json');
    $response = Unirest\Request::get("http://65.109.136.86/json/stations/bytag/" . $genre . "?limit=10000&hidebroken=true", $headers);
    if ($response->code == 200) {
        $data = array();
        foreach ($response->body as $v) {
            $res_array = array();
            $res_array['name'] = $v->name;
            $res_array['url'] = $v->url;
            $res_array['bitrate'] = $v->bitrate;
            $res_array['codec'] = $v->codec;
            $res_array['countrycode'] = $v->countrycode;
            $res_array['stationuuid'] = $v->stationuuid;
            $data[] = $res_array;
        }
        foreach ($data as $ke => $ve) {
            if ($ve['countrycode'] != strtoupper($country)) {
                unset($data[$ke]);
            }
        }
        echo json_encode($data);
    } else {
        echo "Error: " . $response->code . " - " . $response->statusText;
    }
}
