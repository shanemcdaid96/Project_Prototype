<?php

$host = 'dentalapp-server.mysql.database.azure.com';
$username = 'shane@dentalapp-server';
$password = 'Gonero.32';
$db_name = 'dental_practice';

//Establishes the connection
$conn = mysqli_init();
mysqli_real_connect($conn, $host, $username, $password, $db_name, 3306);
if (mysqli_connect_errno($conn)) {
die('Failed to connect to MySQL: '.mysqli_connect_error());
}
?>