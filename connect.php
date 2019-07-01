<?php

$server   = 'localhost';
$username = 'root';
$password = '';
$database = 'forum';

$conn = mysqli_connect($server, $username,  $password, $database);
 
if (!$conn) {
    die('Error: could not establish MySQL database connection');
}

session_start();

?>
