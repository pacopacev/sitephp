<?php

$json = file_get_contents('radio/CountryCodes.json');
// Check if the file was read successfully
if ($json === false) {
    die('Error reading the JSON file');
}

// Decode the JSON file
$countryCodes = json_decode($json, true); 

// Check if the JSON was decoded successfully
if ($countryCodes === null) {
    die('Error decoding the JSON file');
}

 //Display data
//echo "<pre>";
//print_r($json_data);
//echo "</pre>";
//
//
//exit;

