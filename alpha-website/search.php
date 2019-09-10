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
$sql_semester = "SELECT semester_id, semester_title, start_date FROM semester ORDER BY start_date DESC";
$result_semester = $conn->query($sql_semester);

$sql_department = "SELECT department_id, department_name FROM department ORDER BY department_name ASC";
$result_department = $conn->query($sql_department);

$sql_type = "SELECT type_id, type_name FROM course_type ORDER BY type_id ASC";
$result_type = $conn->query($sql_type);

$sql_credits = "SELECT DISTINCT credit_hours FROM course ORDER BY credit_hours ASC";
$result_credits = $conn->query($sql_credits);

$sql_instructor = "SELECT instructor_id, first_name, last_name FROM instructor ORDER BY last_name ASC";
$result_instructor = $conn->query($sql_instructor);

$sql_level = "SELECT level_id, level_name FROM course_level ORDER BY level_id ASC";
$result_level = $conn->query($sql_level);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Course Search</title>
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

    <body style="margin-bottom:35px;">

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
                <ul class="nav navbar-nav">
                    <li><a href="dashboard.php">Dashboard</a></li>
                    <li><a href="profile.php">Student Profile</a></li>
                    <li class="active"><a href="search.php">Course Search</a></li>
                    <li><a href="registration.php">Registration</a></li>
                    <li><a href="financial.php">Financial Aid</a></li>
                </ul>
                </div>
            </div>
        </nav>

        <div class="container">

            <h1>Course Search</h1>
            <p style="margin-bottom:35px;">Search for courses by entering your criteria below.</p>

            <form action="results.php" method="get">
                <div class="row">
                    <div class="col-sm-4">
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
                            <label>Department</label>
                            <select class="form-control" name="department">
                              <option disabled selected value>Select Department</option>
                              <?php
                              while($row_department = $result_department->fetch_assoc()) {
                                  echo "<option value='" . $row_department[department_id] . "'>" . $row_department[department_name] . "</option>";
                              }
                              ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Course Number</label>
                            <input type="text" class="form-control" name="course-number">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <label>Course Title</label>
                            <input type="text" class="form-control" name="course-title">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Course Environment</label>
                            <select class="form-control" name="type">
                              <option disabled selected value>Select Course Environment</option>
                              <?php
                              while($row_type = $result_type->fetch_assoc()) {
                                  echo "<option value='" . $row_type[type_id] . "'>" . $row_type[type_name] . "</option>";
                              }
                              ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label>Credit Hours</label>
                            <select class="form-control" name="credits">
                              <option disabled selected value>Select Credit Hours</option>
                              <?php
                              while($row_credits = $result_credits->fetch_assoc()) {
                                  echo "<option value='" . $row_credits[credit_hours] . "'>" . $row_credits[credit_hours] . "</option>";
                              }
                              ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Instructor</label>
                            <select class="form-control" name="instructor">
                              <option disabled selected value>Select Instructor</option>
                              <?php
                              while($row_instructor = $result_instructor->fetch_assoc()) {
                                  echo "<option value='" . $row_instructor[instructor_id] . "'>" . $row_instructor[first_name] . " " . $row_instructor[last_name] . "</option>";
                              }
                              ?>
                            </select>

                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Course Level</label>
                            <select class="form-control" name="level">
                              <option disabled selected value>Select Course Level</option>
                              <?php
                              while($row_level = $result_level->fetch_assoc()) {
                                  echo "<option value='" . $row_level[level_id] . "'>" . $row_level[level_name] . "</option>";
                              }
                              ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Meeting Days</label><br>
                            <input type="checkbox" name="days" value="M"> Monday
                            <input type="checkbox" name="days" value="T" style="margin-left:25px;"> Tuesday
                            <input type="checkbox" name="days" value="W" style="margin-left:25px;"> Wednesday
                            <input type="checkbox" name="days" value="R" style="margin-left:25px;"> Thursday
                            <input type="checkbox" name="days" value="F" style="margin-left:25px;"> Friday
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>Meeting Times</label>
                            <select class="form-control" name="times">
                              <option disabled selected value>Select Meeting Time</option>
                              <option value="8">8:00am</option>
                              <option value="9">9:00am</option>
                              <option value="10">10:00am</option>
                              <option value="11">11:00am</option>
                              <option value="12">12:00pm</option>
                              <option value="13">1:00pm</option>
                              <option value="14">2:00pm</option>
                              <option value="15">3:00pm</option>
                              <option value="16">4:00pm</option>
                              <option value="17">5:00pm</option>
                              <option value="18">6:00pm</option>
                              <option value="19">7:00pm</option>
                              <option value="20">8:00pm</option>
                              <option value="21">9:00pm</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-default">Submit</button>

            </form>

        </div>

    </body>

</html>
