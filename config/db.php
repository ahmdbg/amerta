<?php
$hostname = 'localhost';
$username = 'u255726978_amerta_db';
$password = '!Wops5Wj@5';
$database = 'u255726978_amerta_db';

$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>