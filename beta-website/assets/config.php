<?php
$servername = "sql300.epizy.com";
$server_username = "epiz_24469068";
$server_password = "2gpwL6TuTXfO2K";
$dbname = "epiz_24469068_aggie_access";

$conn = new mysqli($servername, $server_username, $server_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
