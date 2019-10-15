<?php
include '../assets/config.php';

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: ../index.php');
	exit();
}

if ($_SESSION['user_type_id'] !== (int)'2') {
	header('Location: ../index.php');
	exit();
}
?>
