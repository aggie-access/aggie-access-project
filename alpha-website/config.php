<?php
$servername = "localhost";
$server_username = "fud3zeefngbk";
$server_password = "7s3DuH@m";
$dbname = "aggie_access";

$conn = new mysqli($servername, $server_username, $server_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>