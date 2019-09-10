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
$banner_id=$_SESSION['username'];

$sql_personal="SELECT first_name, middle_initial, last_name, address, birth_date, phone_number, student_email, graduation_year FROM student WHERE banner_id='$banner_id'";
$result_personal = $conn->query($sql_personal);
$row_personal = $result_personal->fetch_assoc();

$first_name=$row_personal["first_name"];
$middle_initial=$row_personal["middle_initial"];
$last_name=$row_personal["last_name"];
$address=$row_personal["address"];
$birth_date=date('M j, Y', strtotime($row_personal["birth_date"]));
$phone_number=$row_personal["phone_number"];
$student_email=$row_personal["student_email"];
$graduation_year=$row_personal["graduation_year"];

$sql_student="SELECT level_name, classification_title, college_name, degree_title, major_title
FROM student, course_level, classification, college, degree, major
WHERE banner_id='$banner_id' AND student.level_id=course_level.level_id AND student.classification_id=classification.classification_id AND student.college_id=college.college_id AND student.degree_id=degree.degree_id AND student.major_id=major.major_id";
$result_student = $conn->query($sql_student);
$row_student = $result_student->fetch_assoc();
$level_name=$row_student["level_name"];
$classification_title=$row_student["classification_title"];
$college_name=$row_student["college_name"];
$degree_title=$row_student["degree_title"];
$major_title=$row_student["major_title"];

$sql_semester = "SELECT DISTINCT semester.semester_id, semester_title FROM semester, registration WHERE banner_id='$banner_id' AND semester.semester_id=registration.semester_id ORDER BY start_date DESC";
$result_semester = $conn->query($sql_semester);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $semester_id=$_POST['semester-id'];
    $sql_schedule = "SELECT subject_abbreviation, course_number, section_number, course_title, credit_hours, first_name, last_name, type_name, meeting_days, start_time, end_time, meeting_location
    FROM registration, section, instructor, course, subject, course_type
    WHERE banner_id='$banner_id' AND section.crn=registration.crn AND section.instructor_id=instructor.instructor_id AND registration.semester_id='$semester_id' AND section.course_id=course.course_id AND course.subject_id=subject.subject_id AND section.type_id=course_type.type_id
    ORDER BY subject_abbreviation ASC, course_number ASC";
    $result_schedule = $conn->query($sql_schedule);
}

$sql_transcript = "SELECT subject_abbreviation, course_number, course_title, credit_hours, level_name, grades.letter_grade, quality_points*credit_hours AS quality_points
FROM grades, registration, section, course, course_level, subject, grading_scale
WHERE banner_id='$banner_id' AND registration.registration_id=grades.registration_id AND section.course_id=course.course_id AND registration.crn=section.crn AND course.level_id=course_level.level_id AND course.subject_id=subject.subject_id AND grades.letter_grade=grading_scale.letter_grade
ORDER BY subject_abbreviation ASC, course_number ASC";
$result_transcript = $conn->query($sql_transcript);

$sql_attempted="SELECT SUM(credit_hours) AS attempted_hours
FROM grades, registration, section, course, grading_scale
WHERE banner_id='$banner_id' AND registration.registration_id=grades.registration_id AND section.course_id=course.course_id AND registration.crn=section.crn AND grades.letter_grade=grading_scale.letter_grade AND grades.letter_grade IS NOT NULL";
$result_attempted = $conn->query($sql_attempted);
$row_attempted = $result_attempted->fetch_assoc();

$attempted_hours=$row_attempted["attempted_hours"];

$sql_earned="SELECT SUM(credit_hours) AS earned_hours
FROM grades, registration, section, course, grading_scale
WHERE banner_id='$banner_id' AND registration.registration_id=grades.registration_id AND section.course_id=course.course_id AND registration.crn=section.crn AND grades.letter_grade=grading_scale.letter_grade AND grades.letter_grade IS NOT NULL";
$result_earned = $conn->query($sql_earned);
$row_earned = $result_earned->fetch_assoc();

$earned_hours=$row_earned["earned_hours"];

$sql_points="SELECT SUM(quality_points*credit_hours) AS quality_points
FROM grades, registration, section, course, grading_scale
WHERE banner_id='$banner_id' AND registration.registration_id=grades.registration_id AND section.course_id=course.course_id AND registration.crn=section.crn AND grades.letter_grade=grading_scale.letter_grade AND grades.letter_grade IS NOT NULL";
$result_points = $conn->query($sql_points);
$row_points = $result_points->fetch_assoc();

$quality_points=$row_points["quality_points"];

$gpa=$quality_points/$earned_hours;
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Student Profile</title>
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

    <body>

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
                    <li class="active"><a href="profile.php">Student Profile</a></li>
                    <li><a href="search.php">Course Search</a></li>
                    <li><a href="registration.php">Registration</a></li>
                    <li><a href="financial.php">Financial Aid</a></li>
                </ul>
                </div>
            </div>
        </nav>

        <div class="container">

            <h1>Student Profile</h1>
            <p style="margin-bottom:35px;">Your student profile is where you can view all of your personal records, including your current academic status, your class schedule, and your academic transcript.</p>

            <h3>Personal Information</h3>
            <p style="margin-bottom:20px;">This is you personal profile information that is included in the university's directory.</p>

            <table class="table table-striped" style="margin-bottom:35px;">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Birth Date</th>
                        <th>Phone</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $first_name . " " . $middle_initial . ". " . $last_name; ?></td>
                        <td><?php echo $address; ?></td>
                        <td><?php echo $birth_date; ?></td>
                        <td>
                            <?php
                            $phone_1 = substr($phone_number, 0, 3);
                            $phone_2 = substr($phone_number, 3, 3);
                            $phone_3 = substr($phone_number, 6, 4);
                            echo $phone_1 . "-" . $phone_2 . "-" . $phone_3;
                        ?>
                        </td>
                        <td><?php echo $student_email; ?></td>
                    </tr>
                </tbody>
            </table>

            <h3>Student Information</h3>
            <p style="margin-bottom:20px;">This is your student profile information that is included in the university's directory.</p>

            <table class="table table-striped" style="margin-bottom:35px;">
                <thead>
                    <tr>
                        <th>Level</th>
                        <th>Classification</th>
                        <th>College Affiliation</th>
                        <th>Degree Type</th>
                        <th>Major</th>
                        <th>Graduation Year</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $level_name; ?></td>
                        <td><?php echo $classification_title; ?></td>
                        <td><?php echo $college_name; ?></td>
                        <td><?php echo $degree_title; ?></td>
                        <td><?php echo $major_title; ?></td>
                        <td><?php echo $graduation_year; ?></td>
                    </tr>
                </tbody>
            </table>

            <h3>Class Schedule</h3>
            <p style="margin-bottom:20px;">Select a semester below to view your class schedule.</p>

            <form method="post">
                <div class="row" style="margin-bottom:10px;">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <select id="semester-id" class="form-control" name="semester-id" onchange="this.form.submit();">
                              <option disabled selected value>Select Semester</option>
                              <?php
                              while($row_semester = $result_semester->fetch_assoc()) {
                                  echo "<option ";
                                  if ($semester_id == $row_semester[semester_id] ) {
                                      echo 'selected ';
                                  }
                                  echo "value='" . $row_semester[semester_id] . "'>" . $row_semester[semester_title] . "</option>";
                              }
                              ?>
                            </select>
                        </div>
                    </div>
                </div>
            </form>

            <?php
            if ($result_schedule->num_rows > 0) {
                echo "<div style='margin-bottom:35px;'>";
                echo "<table class='table table-striped'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Course</th>";
                echo "<th style='width:300px;'>Title</th>";
                echo "<th>Credits</th>";
                echo "<th>Instructor</th>";
                echo "<th>Type</th>";
                echo "<th>Days</th>";
                echo "<th>Times</th>";
                echo "<th>Location</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while($row_schedule = $result_schedule->fetch_assoc()) {
                    echo "<tr>" .
                    "<td>" . $row_schedule["subject_abbreviation"] . " " . $row_schedule["course_number"] . " | " . $row_schedule["section_number"] .  "</td>" .
                    "<td>" . $row_schedule["course_title"] . "</td>" .
                    "<td>" . $row_schedule["credit_hours"] . "</td>" .
                    "<td>" . $row_schedule["first_name"] . " " . $row_schedule["last_name"] .  "</td>" .
                    "<td>" . $row_schedule["type_name"]. "</td>" ;

                    if ($row_schedule["meeting_days"] === "")
                    {
                        echo "<td>N/A</td>";
                        echo "<td>N/A</td>";
                    } else {
                        echo "<td>" . $row_schedule["meeting_days"] . "</td>" .
                        "<td>" . date('g:i A', strtotime($row_schedule["start_time"])) . " - " . date('g:i A', strtotime($row_schedule["end_time"])) .  "</td>";
                    }

                    echo "<td>" . $row_schedule["meeting_location"]. "</td>" .
                    "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            }
            ?>

            <h3>Academic Transcript</h3>
            <p style="margin-bottom:20px;">Below is an unofficial copy of your current academic transcript.</p>

            <table class="table table-striped" style="margin-bottom:35px;">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Title</th>
                        <th>Credits</th>
                        <th>Level</th>
                        <th>Grade</th>
                        <th>Quality Points</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    while($row_transcript = $result_transcript->fetch_assoc()) {
                        echo "<tr>" .
                        "<td>" . $row_transcript["subject_abbreviation"] . " " . $row_transcript["course_number"] . "</td>" .
                        "<td>" . $row_transcript["course_title"] . "</td>" .
                        "<td>" . $row_transcript["credit_hours"] . "</td>" .
                        "<td>" . $row_transcript["level_name"]. "</td>" .
                        "<td>" . $row_transcript["letter_grade"]. "</td>" .
                        "<td>" . $row_transcript["quality_points"]. "</td>" .
                        "</tr>";
                    }
                    ?>

                </tbody>
            </table>

            <h4 style="margin-bottom:15px;">Transcript Summary</h4>
            <table class="table table-striped" style="margin-bottom:35px;">
                <thead>
                    <tr>
                        <th>Attempted Credit Hours</th>
                        <th>Earned Credit Hours</th>
                        <th>Quality Points</th>
                        <th>Overall Grade Point Average</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $attempted_hours; ?></td>
                        <td><?php echo $earned_hours; ?></td>
                        <td><?php echo $quality_points; ?></td>
                        <td><?php echo $gpa; ?></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </body>
</html>
