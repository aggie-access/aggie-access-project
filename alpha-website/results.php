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
$semester_id=$_GET["semester"];
$department_id=$_GET["department"];
$course_number=$_GET["course-number"];
$course_title=$_GET["course-title"];
$course_type=$_GET["type"];
$credit_hours=$_GET["credits"];
$instructor_id=$_GET["instructor"];
$level_id=$_GET["level"];
$meeting_days=$_GET["days"];
$meeting_times=$_GET["times"];
$sql_search = "SELECT crn, subject_abbreviation, course_number, section_number, course_title, credit_hours, first_name, last_name, type_name, meeting_days, start_time, end_time, meeting_location
FROM course, section, subject, instructor, course_type, semester, department, course_level
WHERE section.semester_id=semester.semester_id AND section.instructor_id=instructor.instructor_id AND section.type_id=course_type.type_id AND course.subject_id=subject.subject_id AND course.course_id=section.course_id AND course.department_id=department.department_id AND course.level_id=course_level.level_id AND semester.semester_id='$semester_id' AND department.department_id='$department_id' AND course_number='$course_number' AND course_title LIKE '%$course_title%' AND credit_hours='$credit_hours' AND instructor.instructor_id='$instructor_id' AND course_level.level_id='$level_id' AND meeting_days LIKE '%$meeting_days%'
ORDER BY subject_abbreviation ASC, course_number ASC, section_number ASC";
$result_search = $conn->query($sql_search);
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Course Results</title>
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
                    <li class="active"><a href="search.php">Course Search</a></li>
                    <li><a href="registration.php">Registration</a></li>
                    <li><a href="financial.php">Financial Aid</a></li>
                </ul>
                </div>
            </div>
        </nav>

        <div class="container">

            <h1>Course Results</h1>

            <?php
            if ($result_search->num_rows > 0) {
                echo "<p style='margin-bottom:35px;'>These courses match your criteria. You can click on the course reference numbers (CRN) to see more information about each course.</p>";
                echo "<table class='table table-striped'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>CRN</th>";
                echo "<th>Course</th>";
                echo "<th>Section</th>";
                echo "<th style='width:200px;'>Title</th>";
                echo "<th>Credits</th>";
                echo "<th>Instructor</th>";
                echo "<th>Type</th>";
                echo "<th>Days</th>";
                echo "<th>Times</th>";
                echo "<th>Location</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                
                while($row_search = $result_search->fetch_assoc()) {
                    echo "<tr>" .
                    "<td><a href='/information.php?id=" . $row_search["crn"] . "'</a>" . $row_search["crn"] . "</td>" .
                    "<td>" . $row_search["subject_abbreviation"] . " " . $row_search["course_number"] . "</td>" .
                    "<td>" . $row_search["section_number"] . "</td>" .
                    "<td>" . $row_search["course_title"] . "</td>" .
                    "<td>" . $row_search["credit_hours"] . "</td>" .
                    "<td>" . $row_search["first_name"] . " " . $row_search["last_name"] .  "</td>" .
                    "<td>" . $row_search["type_name"]. "</td>" ;
                    
                    if ($row_search["meeting_days"] === "")
                    {
                        echo "<td>N/A</td>";
                        echo "<td>N/A</td>";
                    } else {
                        echo "<td>" . $row_search["meeting_days"] . "</td>" .
                        "<td>" . date('g:i A', strtotime($row_search["start_time"])) . " - " . date('g:i A', strtotime($row_search["end_time"])) .  "</td>";
                    }
                    
                    echo "<td>" . $row_search["meeting_location"]. "</td>" . 
                    "</tr>";
                }
                
                echo "</tbody>";
                echo "</table>";
            }
            else {
                echo "<p style='margin-top:35px;'>Sorry, there are no courses that match your search criteria.</p>";
            }
            ?>
        </div>

    </body>

</html>
