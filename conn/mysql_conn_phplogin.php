<?php

$DATABASE_HOST = 'sql203.infinityfree.com';
$DATABASE_USER = 'if0_36973486';
$DATABASE_PASS = '1GdNvDWSnlI';
$DATABASE_NAME = 'if0_36973486_phplogin';
// Try and connect using the info above.
$connection_if0_36973486_phplogin = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if ( mysqli_connect_errno() ) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

