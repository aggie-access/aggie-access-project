<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Dashboard</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="images/favicon.png" type="image/png" sizes="16x16">
        <link href='https://fonts.googleapis.com/css?family=Proxima+Nova:400,700' rel='stylesheet'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css">
    </head>

    <body style="margin-top:120px;">

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container" style="height:80px;">
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php"><img src="images/Logo.png" style="width:325px;"></a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php" class="logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </div>
            <div class="container-fluid" style="background:#004684;">
                <div class="container">
                    <div class="navbar-header welcome-message">
                        Welcome, <?=$_SESSION['name']?>!
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <a href="profile.php">
                    <div class="col-sm-6 dashboard-odd">
                        <div class="dashboard-link">
                            <i class="fas fa-user-graduate" style="font-size:50px;"></i>
                            <h2>Student Profile</h2>
                            <p>Review your student profile.</p>
                        </div>
                    </div>
                </a>
                <a href="search.php">
                    <div class="col-sm-6 dashboard-even">
                        <div class="dashboard-link">
                            <i class="fas fa-search" style="font-size:50px;"></i>
                            <h2>Course Search</h2>
                            <p>Search for courses for the upcoming semester.</p>
                        </div>
                    </div>
                </a>
                <a href="registration.php">
                    <div class="col-sm-6 dashboard-even">
                        <div class="dashboard-link">
                            <i class="fas fa-university" style="font-size:50px;"></i>
                            <h2>Registration</h2>
                            <p>Register for courses for the upcoming semester.</p>
                        </div>
                    </div>
                </a>
                <a href="financial.php">
                    <div class="col-sm-6 dashboard-odd">
                        <div class="dashboard-link">
                            <i class="fas fa-dollar-sign" style="font-size:50px;"></i>
                            <h2>Financial Aid</h2>
                            <p>Review your current financial aid status.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </body>

</html>
