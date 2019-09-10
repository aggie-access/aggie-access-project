<?php
$servername = "localhost:3306";
$server_username = "root";
$server_password = "password";
$dbname = "aggie_access";

$conn = new mysqli($servername, $server_username, $server_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
