<?php
include 'config.php';
?>

<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.php');
	exit();
}
?>

<?php
$sql_semester = "SELECT semester_id, semester_title FROM semester WHERE start_date>=CURDATE() ORDER BY start_date DESC";
$result_semester = $conn->query($sql_semester);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Registration</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="/images/favicon.png" type="image/png" sizes="16x16">
        <link href='https://fonts.googleapis.com/css?family=Proxima+Nova:400,700' rel='stylesheet'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/stylesheets/stylesheet.css">
    </head>

    <body>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container" style="height:80px;">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/dashboard.php"><img src="/images/Logo.png" style="width:325px;"></a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/logout.php" class="logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                </ul>
            </div>
            <div class="container-fluid" style="background:#004684;">
                <div class="container">
                    <div class="navbar-header welcome-message">
                        Welcome, <?=$_SESSION['name']?>!
                    </div>
                <ul class="nav navbar-nav">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="profile.php">Student Profile</a></li>
                    <li><a href="search.php">Course Search</a></li>
                    <li class="active"><a href="registration.php">Registration</a></li>
                    <li><a href="financial.php">Financial Aid</a></li>
                </ul>
                </div>
            </div>
        </nav>

        <div class="container">

            <h1>Registration</h1>
            <p style="margin-bottom:35px;">Enter the course reference number (CRN) for each of your selections below. You must provide your registration PIN that was given to you by your advisor in order to register for the upcoming semester.</p>

            <form action="confirmation.php" method="post">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Semester</label>
                            <select class="form-control" name="semester" required>
                              <option disabled selected value>Select Semester</option>
                              <?php
                              while($row_semester = $result_semester->fetch_assoc()) {
                                  echo "<option value='" . $row_semester[semester_id] . "'>" . $row_semester[semester_title] . "</option>";
                              }
                              ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Registration PIN</label>
                            <input type="text" class="form-control" name="pin" minlength="6" maxlength="6" size="6" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h4>Enter up to six distinct course reference numbers (CRNs) below for each of your course selections.</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" name="crn-1" minlength="5" maxlength="5" size="5" required>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" name="crn-2" minlength="5" maxlength="5" size="5">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" name="crn-3" minlength="5" maxlength="5" size="5">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" name="crn-4" minlength="5" maxlength="5" size="5">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" name="crn-5" minlength="5" maxlength="5" size="5">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <input type="text" class="form-control" name="crn-6" minlength="5" maxlength="5" size="5">
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-default">Submit</button>

            </form>

        </div>

    </body>

</html>
