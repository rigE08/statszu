<?php

$msg[0] = "Can't connect to database!";
$msg[1] = "Not possible to select the database(maybe wrong name).";

$db_user = "root"; //User
$db_password = ""; //Password
$db_name = "csgo"; //Database name
$host = "127.0.0.1"; //Database host

$db_table = "rankme"; // Table name

$conn = mysqli_connect($host,$db_user,$db_password) or die($msg[0]);
mysqli_select_db($conn, $db_name) or die($msg[1]);
?>