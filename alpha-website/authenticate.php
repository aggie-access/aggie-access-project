<?php
include 'config.php';
?>

<?php
session_start();

if ( !isset($_POST['username'], $_POST['password']) ) {
	die ('You are not logged in. Please log in to access this page.');
}

if ($stmt = $conn->prepare('SELECT banner_id, password FROM users WHERE banner_id = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
	
	if ($stmt->num_rows > 0) {
	    $stmt->bind_result($username, $password);
	    $stmt->fetch();
	    if ($_POST['password'] === $password) {
	        session_regenerate_id();
	        $_SESSION['loggedin'] = TRUE;
	        $_SESSION['username'] = $_POST['username'];
	        
	        $banner_id=$_POST['username'];
	        
	        $sql="SELECT first_name FROM student WHERE banner_id='$banner_id'";
	        $result = $conn->query($sql);
	        $row = $result->fetch_assoc();

	        $_SESSION['name'] = $row["first_name"];
	        
	        header('Location: dashboard.php');
	    } else {
	        header('Location: index.php?error=1');
	    }
	    
	} else {
	    header('Location: index.php?error=1');
	}
	$stmt->close();
}
?>