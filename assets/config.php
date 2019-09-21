<?php
$servername = "localhost";
$server_username = "fg31igihj6wh";
$server_password = "fjN*70v5s";
$dbname = "aggie_access_";

$conn = new mysqli($servername, $server_username, $server_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
