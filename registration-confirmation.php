<?php
include 'assets/connect.php';

$semester_id=$_POST["semester"];

$sql_semester = "SELECT semester_title, start_date, finish_date FROM semester WHERE semester_id='$semester_id'";
$result_semester = $conn->query($sql_semester);
$row_semester = $result_semester->fetch_assoc();
$semester_title=$row_semester["semester_title"];
$start_date=date('F j, Y', strtotime($row_semester["start_date"]));
$finish_date=date('F j, Y', strtotime($row_semester["finish_date"]));

$input_pin=$_POST["pin"];

$banner_id=$_SESSION['username'];

$sql_pin = "SELECT registration_pin FROM registration_pin WHERE banner_id='$banner_id' AND semester_id='$semester_id'";
$result_pin = $conn->query($sql_pin);
$row_pin = $result_pin->fetch_assoc();
$registration_pin=$row_pin["registration_pin"];

$crn_1=$_POST["crn-1"];

$sql_class_1 = "SELECT crn, subject_abbreviation, course_number, section_number, course_title, credit_hours, first_name, last_name, type_name, meeting_days, start_time, end_time, meeting_location
FROM section, course, subject, instructor, course_type, semester
WHERE crn='$crn_1' AND section.course_id=course.course_id AND course.subject_id=subject.subject_id AND section.instructor_id=instructor.instructor_id AND section.type_id=course_type.type_id AND section.semester_id=semester.semester_id AND semester.semester_id='$semester_id'";
$result_class_1 = $conn->query($sql_class_1);
$row_class_1 = $result_class_1->fetch_assoc();

$crn_2=$_POST["crn-2"];

$sql_class_2 = "SELECT crn, subject_abbreviation, course_number, section_number, course_title, credit_hours, first_name, last_name, type_name, meeting_days, start_time, end_time, meeting_location
FROM section, course, subject, instructor, course_type, semester
WHERE crn='$crn_2' AND section.course_id=course.course_id AND course.subject_id=subject.subject_id AND section.instructor_id=instructor.instructor_id AND section.type_id=course_type.type_id AND section.semester_id=semester.semester_id AND semester.semester_id='$semester_id'";
$result_class_2 = $conn->query($sql_class_2);
$row_class_2 = $result_class_2->fetch_assoc();

$crn_3=$_POST["crn-3"];

$sql_class_3 = "SELECT crn, subject_abbreviation, course_number, section_number, course_title, credit_hours, first_name, last_name, type_name, meeting_days, start_time, end_time, meeting_location
FROM section, course, subject, instructor, course_type, semester
WHERE crn='$crn_3' AND section.course_id=course.course_id AND course.subject_id=subject.subject_id AND section.instructor_id=instructor.instructor_id AND section.type_id=course_type.type_id AND section.semester_id=semester.semester_id AND semester.semester_id='$semester_id'";
$result_class_3 = $conn->query($sql_class_3);
$row_class_3 = $result_class_3->fetch_assoc();

$crn_4=$_POST["crn-4"];

$sql_class_4 = "SELECT crn, subject_abbreviation, course_number, section_number, course_title, credit_hours, first_name, last_name, type_name, meeting_days, start_time, end_time, meeting_location
FROM section, course, subject, instructor, course_type, semester
WHERE crn='$crn_4' AND section.course_id=course.course_id AND course.subject_id=subject.subject_id AND section.instructor_id=instructor.instructor_id AND section.type_id=course_type.type_id AND section.semester_id=semester.semester_id AND semester.semester_id='$semester_id'";
$result_class_4 = $conn->query($sql_class_4);
$row_class_4 = $result_class_4->fetch_assoc();

$crn_5=$_POST["crn-5"];

$sql_class_5 = "SELECT crn, subject_abbreviation, course_number, section_number, course_title, credit_hours, first_name, last_name, type_name, meeting_days, start_time, end_time, meeting_location
FROM section, course, subject, instructor, course_type, semester
WHERE crn='$crn_5' AND section.course_id=course.course_id AND course.subject_id=subject.subject_id AND section.instructor_id=instructor.instructor_id AND section.type_id=course_type.type_id AND section.semester_id=semester.semester_id AND semester.semester_id='$semester_id'";
$result_class_5 = $conn->query($sql_class_5);
$row_class_5 = $result_class_5->fetch_assoc();

$crn_6=$_POST["crn-6"];

$sql_class_6 = "SELECT crn, subject_abbreviation, course_number, section_number, course_title, credit_hours, first_name, last_name, type_name, meeting_days, start_time, end_time, meeting_location
FROM section, course, subject, instructor, course_type, semester
WHERE crn='$crn_6' AND section.course_id=course.course_id AND course.subject_id=subject.subject_id AND section.instructor_id=instructor.instructor_id AND section.type_id=course_type.type_id AND section.semester_id=semester.semester_id AND semester.semester_id='$semester_id'";
$result_class_6 = $conn->query($sql_class_6);
$row_class_6 = $result_class_6->fetch_assoc();

$total_credits=$row_class_1["credit_hours"]+$row_class_2["credit_hours"]+$row_class_3["credit_hours"]+$row_class_4["credit_hours"]+$row_class_5["credit_hours"]+$row_class_6["credit_hours"];
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Registration Confirmation</title>
				<?php include 'assets/header.php'; ?>
				<script type="text/javascript">
				$(document).ready(function(){
					$("#course-registration").addClass("active");
				});
				</script>
    </head>

    <body style="margin-bottom:35px;">

        <?php include 'assets/navbar.php'; ?>

        <div class="container">

            <h1>Registration Confirmation</h1>

                        <?php
                        if ($registration_pin===$input_pin) {
                            if ($result_class_1->num_rows > 0) {
                                $register_class_1 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_1')");

                                echo "<p style='margin-bottom:20px;'>You have been successfully registered for the upcoming semester.</p>";
                                echo "<div class='row' style='margin-bottom:15px;'>";
                                echo "<div class='col-sm-3'>";
                                echo "<h3>" . $semester_title . "</h3>";
                                echo "</div>";
                                echo "<div class='col-sm-6'>";
                                echo "<h3 style='text-align:center;'>" . $start_date . " - " . $finish_date . "</h3>";
                                echo "</div>";
                                echo "<div class='col-sm-3'>";
                                if ($total_credits===1) {
                                    echo "<h3 style='text-align:right;'>" . $total_credits . " Credit</h3>";
                                } else {
                                    echo "<h3 style='text-align:right;'>" . $total_credits . " Credits</h3>";
                                }
                                echo "</div>";
                                echo "</div>";
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
                                echo "<tr>";
                                echo "<td><a href='information.php?id=" . $row_class_1["crn"] . "'>" . $row_class_1["crn"] . "</a></td>";
                                echo "<td>" . $row_class_1["subject_abbreviation"] . " " . $row_class_1["course_number"] . "</td>";
                                echo "<td>" . $row_class_1["section_number"] . "</td>";
                                echo "<td>" . $row_class_1["course_title"] . "</td>";
                                echo "<td>" . $row_class_1["credit_hours"] . "</td>";
                                echo "<td>" . $row_class_1["first_name"] . " " . $row_class_1["last_name"] . "</td>";
                                echo "<td>" . $row_class_1["type_name"] . "</td>";
                                if ($row_class_1["meeting_days"] === "") {
                                    echo "<td>N/A</td>";
                                    echo "<td>N/A</td>";
                                } else {
                                    echo "<td>" . $row_class_1["meeting_days"] . "</td>" .
                                    "<td>" . date('g:i A', strtotime($row_class_1["start_time"])) . " - " . date('g:i A', strtotime($row_class_1["end_time"])) .  "</td>";
                                }
                                echo "<td>" . $row_class_1["meeting_location"] . "</td>";
                                echo "</tr>";
                                if ($result_class_2->num_rows > 0) {
                                    $register_class_2 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_2')");

                                    echo "<tr>";
                                    echo "<td><a href='information.php?id=" . $row_class_2["crn"] . "'>" . $row_class_2["crn"] . "</a></td>";
                                    echo "<td>" . $row_class_2["subject_abbreviation"] . " " . $row_class_2["course_number"] . "</td>";
                                    echo "<td>" . $row_class_2["section_number"] . "</td>";
                                    echo "<td>" . $row_class_2["course_title"] . "</td>";
                                    echo "<td>" . $row_class_2["credit_hours"] . "</td>";
                                    echo "<td>" . $row_class_2["first_name"] . " " . $row_class_2["last_name"] . "</td>";
                                    echo "<td>" . $row_class_2["type_name"] . "</td>";
                                    if ($row_class_2["meeting_days"] === "") {
                                        echo "<td>N/A</td>";
                                        echo "<td>N/A</td>";
                                    } else {
                                        echo "<td>" . $row_class_2["meeting_days"] . "</td>" .
                                        "<td>" . date('g:i A', strtotime($row_class_2["start_time"])) . " - " . date('g:i A', strtotime($row_class_2["end_time"])) .  "</td>";
                                    }
                                    echo "<td>" . $row_class_2["meeting_location"] . "</td>";
                                    echo "</tr>";
                                }
                                if ($result_class_3->num_rows > 0) {
                                    $register_class_3 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_3')");

                                    echo "<tr>";
                                    echo "<td><a href='information.php?id=" . $row_class_3["crn"] . "'>" . $row_class_3["crn"] . "</a></td>";
                                    echo "<td>" . $row_class_3["subject_abbreviation"] . " " . $row_class_3["course_number"] . "</td>";
                                    echo "<td>" . $row_class_3["section_number"] . "</td>";
                                    echo "<td>" . $row_class_3["course_title"] . "</td>";
                                    echo "<td>" . $row_class_3["credit_hours"] . "</td>";
                                    echo "<td>" . $row_class_3["first_name"] . " " . $row_class_3["last_name"] . "</td>";
                                    echo "<td>" . $row_class_3["type_name"] . "</td>";
                                    if ($row_class_3["meeting_days"] === "") {
                                        echo "<td>N/A</td>";
                                        echo "<td>N/A</td>";
                                    } else {
                                        echo "<td>" . $row_class_3["meeting_days"] . "</td>" .
                                        "<td>" . date('g:i A', strtotime($row_class_3["start_time"])) . " - " . date('g:i A', strtotime($row_class_3["end_time"])) .  "</td>";
                                    }
                                    echo "<td>" . $row_class_3["meeting_location"] . "</td>";
                                    echo "</tr>";
                                }
                                if ($result_class_4->num_rows > 0) {
                                    $register_class_4 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_4')");

                                    echo "<tr>";
                                    echo "<td><a href='information.php?id=" . $row_class_4["crn"] . "'>" . $row_class_4["crn"] . "</a></td>";
                                    echo "<td>" . $row_class_4["subject_abbreviation"] . " " . $row_class_4["course_number"] . "</td>";
                                    echo "<td>" . $row_class_4["section_number"] . "</td>";
                                    echo "<td>" . $row_class_4["course_title"] . "</td>";
                                    echo "<td>" . $row_class_4["credit_hours"] . "</td>";
                                    echo "<td>" . $row_class_4["first_name"] . " " . $row_class_4["last_name"] . "</td>";
                                    echo "<td>" . $row_class_4["type_name"] . "</td>";
                                    if ($row_class_4["meeting_days"] === "") {
                                        echo "<td>N/A</td>";
                                        echo "<td>N/A</td>";
                                    } else {
                                        echo "<td>" . $row_class_4["meeting_days"] . "</td>" .
                                        "<td>" . date('g:i A', strtotime($row_class_4["start_time"])) . " - " . date('g:i A', strtotime($row_class_4["end_time"])) .  "</td>";
                                    }
                                    echo "<td>" . $row_class_4["meeting_location"] . "</td>";
                                    echo "</tr>";
                                }
                                if ($result_class_5->num_rows > 0) {
                                    $register_class_5 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_5')");

                                    echo "<tr>";
                                    echo "<td><a href='information.php?id=" . $row_class_5["crn"] . "'>" . $row_class_5["crn"] . "</a></td>";
                                    echo "<td>" . $row_class_5["subject_abbreviation"] . " " . $row_class_5["course_number"] . "</td>";
                                    echo "<td>" . $row_class_5["section_number"] . "</td>";
                                    echo "<td>" . $row_class_5["course_title"] . "</td>";
                                    echo "<td>" . $row_class_5["credit_hours"] . "</td>";
                                    echo "<td>" . $row_class_5["first_name"] . " " . $row_class_5["last_name"] . "</td>";
                                    echo "<td>" . $row_class_5["type_name"] . "</td>";
                                    if ($row_class_5["meeting_days"] === "") {
                                        echo "<td>N/A</td>";
                                        echo "<td>N/A</td>";
                                    } else {
                                        echo "<td>" . $row_class_5["meeting_days"] . "</td>" .
                                        "<td>" . date('g:i A', strtotime($row_class_5["start_time"])) . " - " . date('g:i A', strtotime($row_class_5["end_time"])) .  "</td>";
                                    }
                                    echo "<td>" . $row_class_5["meeting_location"] . "</td>";
                                    echo "</tr>";
                                }
                                if ($result_class_6->num_rows > 0) {
                                    $register_class_6 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_6')");

                                    echo "<tr>";
                                    echo "<td><a href='information.php?id=" . $row_class_6["crn"] . "'>" . $row_class_6["crn"] . "</a></td>";
                                    echo "<td>" . $row_class_6["subject_abbreviation"] . " " . $row_class_6["course_number"] . "</td>";
                                    echo "<td>" . $row_class_6["section_number"] . "</td>";
                                    echo "<td>" . $row_class_6["course_title"] . "</td>";
                                    echo "<td>" . $row_class_6["credit_hours"] . "</td>";
                                    echo "<td>" . $row_class_6["first_name"] . " " . $row_class_6["last_name"] . "</td>";
                                    echo "<td>" . $row_class_6["type_name"] . "</td>";
                                    if ($row_class_6["meeting_days"] === "") {
                                        echo "<td>N/A</td>";
                                        echo "<td>N/A</td>";
                                    } else {
                                        echo "<td>" . $row_class_6["meeting_days"] . "</td>" .
                                        "<td>" . date('g:i A', strtotime($row_class_6["start_time"])) . " - " . date('g:i A', strtotime($row_class_6["end_time"])) .  "</td>";
                                    }
                                    echo "<td>" . $row_class_6["meeting_location"] . "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                            } else {
                                echo "<p style='margin-top:20px;'>You have not been registered for the upcoming semester. The course reference number(s) that you provided do not match any of the courses being offered during the <strong>" . $semester_title . "</strong> semester.</p>";
                            }
                        } else {
                            echo "<p style='margin-top:20px;'>The registration PIN that you have provided for the <strong>" . $semester_title . "</strong> semester is invalid.</p>";
                        }
                        ?>

        </div>

    </body>

</html>
