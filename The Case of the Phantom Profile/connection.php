<?php
$servername = 'localhost';
$username = 'root';
$password = 'Qwwqoppo1';
$database = 'student';

$connection = mysqli_connect($servername, $username, $password, $database);

if (!$connection) {
  die('Connection failed: ' . mysqli_connect_error());
}