<?php
include 'assets/connect.php';

$crn=$_GET["id"];

$sql_info="SELECT crn, section_number, meeting_days, start_time, end_time, meeting_location, seat_capacity, first_name, middle_initial, last_name, email, office_location, office_phone, course_number, course_title, course_description, credit_hours, subject_abbreviation, type_name, start_date, finish_date, textbook.isbn, textbook_title, textbook_release_year, textbook_edition, author_name, publisher_name
FROM section, instructor, course, subject, course_type, semester, textbook, author, publisher
WHERE crn='$crn' AND section.instructor_id=instructor.instructor_id AND section.course_id=course.course_id AND section.type_id=course_type.type_id AND course.subject_id=subject.subject_id AND section.semester_id=semester.semester_id AND course.isbn=textbook.isbn AND author.author_id=textbook.author_id AND publisher.publisher_id=textbook.publisher_id";
$result_info = $conn->query($sql_info);

$sql_alt="SELECT crn, section_number, meeting_days, start_time, end_time, meeting_location, seat_capacity, first_name, middle_initial, last_name, email, office_location, office_phone, course_number, course_title, course_description, credit_hours, subject_abbreviation, type_name, start_date, finish_date
FROM section, instructor, course, subject, course_type, semester
WHERE crn='$crn' AND section.instructor_id=instructor.instructor_id AND section.course_id=course.course_id AND section.type_id=course_type.type_id AND course.subject_id=subject.subject_id AND section.semester_id=semester.semester_id";
$result_alt = $conn->query($sql_alt);

if ($result_info->num_rows > 0) {
    $row_info = $result_info->fetch_assoc();
    $section=$row_info["section_number"];
    $meeting_days=$row_info["meeting_days"];
    $start_time=date('g:i A', strtotime($row_info["start_time"]));
    $end_time=date('g:i A', strtotime($row_info["end_time"]));
    $meeting_location=$row_info["meeting_location"];
    $seat_capacity=$row_info["seat_capacity"];
    $first_name=$row_info["first_name"];
    $middle_initial=$row_info["middle_initial"];
    $last_name=$row_info["last_name"];
    $email=$row_info["email"];
    $office_location=$row_info["office_location"];
    $office_phone=$row_info["office_phone"];
    $course_number=$row_info["course_number"];
    $course_title=$row_info["course_title"];
    $course_description=$row_info["course_description"];
    $credit_hours=$row_info["credit_hours"];
    $subject_abbreviation=$row_info["subject_abbreviation"];
    $type_name=$row_info["type_name"];
    $start_date=date('F j, Y', strtotime($row_info["start_date"]));
    $finish_date=date('F j, Y', strtotime($row_info["finish_date"]));
    $isbn=$row_info["isbn"];
    $textbook_title=$row_info["textbook_title"];
    $textbook_edition=$row_info["textbook_edition"];
    $textbook_release_year=$row_info["textbook_release_year"];
    $author_name=$row_info["author_name"];
    $publisher_name=$row_info["publisher_name"];
}
else {
    $row_info = $result_alt->fetch_assoc();
    $section=$row_info["section_number"];
    $meeting_days=$row_info["meeting_days"];
    $start_time=date('g:i A', strtotime($row_info["start_time"]));
    $end_time=date('g:i A', strtotime($row_info["end_time"]));
    $meeting_location=$row_info["meeting_location"];
    $seat_capacity=$row_info["seat_capacity"];
    $first_name=$row_info["first_name"];
    $middle_initial=$row_info["middle_initial"];
    $last_name=$row_info["last_name"];
    $email=$row_info["email"];
    $office_location=$row_info["office_location"];
    $office_phone=$row_info["office_phone"];
    $course_number=$row_info["course_number"];
    $course_title=$row_info["course_title"];
    $course_description=$row_info["course_description"];
    $credit_hours=$row_info["credit_hours"];
    $subject_abbreviation=$row_info["subject_abbreviation"];
    $type_name=$row_info["type_name"];
    $start_date=date('F j, Y', strtotime($row_info["start_date"]));
    $finish_date=date('F j, Y', strtotime($row_info["finish_date"]));
    $isbn="";
    $textbook_title="";
    $textbook_edition="";
    $textbook_release_year="";
    $author_name="";
    $publisher_name="";
}

$sql_seats="SELECT COUNT(*) AS seats_taken FROM registration WHERE registration.crn='$crn'";
$result_seats = $conn->query($sql_seats);
$row_seats = $result_seats->fetch_assoc();
$seats_taken=$row_seats["seats_taken"];
$seats_available=$seat_capacity-$seats_taken;

$sql_prerequisite="SELECT subject_abbreviation, p.course_number FROM course AS s, course AS p, section, subject WHERE crn='$crn' AND s.prerequisite_id=p.course_id AND s.course_id=section.course_id AND p.subject_id=subject.subject_id";
$result_prerequisite = $conn->query($sql_prerequisite);
$row_prerequisite = $result_prerequisite->fetch_assoc();
$prerequisite_abbreviation=$row_prerequisite["subject_abbreviation"];
$prerequisite_number=$row_prerequisite["course_number"];

$sql_corequisite="SELECT subject_abbreviation, c.course_number FROM course AS s, course AS c, section, subject WHERE crn='$crn' AND s.corequisite_id=c.course_id AND s.course_id=section.course_id AND c.subject_id=subject.subject_id";
$result_corequisite = $conn->query($sql_corequisite);
$row_corequisite = $result_corequisite->fetch_assoc();
$corequisite_abbreviation=$row_corequisite["subject_abbreviation"];
$corequisite_number=$row_corequisite["course_number"];
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Course Information</title>
				<?php include 'assets/header.php'; ?>
				<script type="text/javascript">
				$(document).ready(function(){
					$("#course-search").addClass("active");
				});
				</script>
    </head>

    <style>
        h4 {
            margin-bottom:5px;
        }
    </style>

    <body style="margin-bottom:35px;">

        <?php include 'assets/navbar.php'; ?>

        <div class="container">

            <div class="row">
                <div class="col-sm-12">
                    <h1><?php echo $subject_abbreviation . " " . $course_number . " | " . $section; ?></h1>
                </div>
                <div class="col-sm-11">
                    <h2 style="margin-top:0;"><?php echo $course_title; ?></h2>
                </div>
                <div class="col-sm-1">
                    <h2 style="margin-top:0;"><?php echo $crn; ?></h2>
                </div>
            </div>

            <p style="margin-bottom:20px;"><?php echo $course_description; ?></p>

            <div class="row">
                <div class="col-sm-2">
                    <h4>Credit Hours</h4>
                    <p><?php echo $credit_hours; ?></p>
                </div>
                <div class="col-sm-2">
                    <h4>Environment</h4>
                    <p><?php echo $type_name; ?></p>
                </div>
                <div class="col-sm-2">
                    <h4>Prerequisites</h4>
                    <p>
                        <?php
                        if ($prerequisite_number === NULL) {
                            echo "None";
                        }
                        else {
                            echo $prerequisite_abbreviation . " " . $prerequisite_number;
                        }
                        ?>
                    </p>
                </div>
                <div class="col-sm-2">
                    <h4>Corequisites</h4>
                    <p>
                        <?php
                        if ($corequisite_number === NULL) {
                            echo "None";
                        }
                        else {
                            echo $corequisite_abbreviation . " " . $corequisite_number;
                        }
                        ?>
                    </p>
                </div>
                <div class="col-sm-2">
                    <h4>Seat Capacity</h4>
                    <p><?php echo $seat_capacity; ?></p>
                </div>
                <div class="col-sm-2">
                    <h4>Seats Available</h4>
                    <p><?php echo $seats_available; ?></p>
                </div>
            </div>

            <div class="row" style="margin-top:25px;">
                <div class="col-sm-4" style="border-right:1px solid;">
                    <h4>Date Range</h4>
                    <p style="margin-bottom:15px;"><?php echo $start_date . " - " . $finish_date; ?></p>
                    <h4>Meeting Days</h4>
                    <p style="margin-bottom:15px;">
                        <?php
                        if ($meeting_days === "") {
                            echo "N/A";
                        }
                        else {
                            $days_initial = ["M", "T", "W", "R", "F"];
                            $days = ["Monday,", " Tuesday,", " Wednesday,", " Thursday,", " Friday,"];
                            echo rtrim(str_replace($days_initial,$days,$meeting_days), ',');
                        }
                        ?>
                    </p>
                    <h4>Meeting Times</h4>
                    <p style="margin-bottom:15px;">
                        <?php
                        if ($meeting_days === "") {
                            echo "N/A";
                        }
                        else {
                            echo $start_time . " - " . $end_time;
                        }
                        ?>
                        </p>
                    <h4>Meeting Location</h4>
                    <p><?php echo $meeting_location; ?></p>
                </div>
                <div class="col-sm-4" style="border-right:1px solid;">
                    <h4>Instructor</h4>
                    <p style="margin-bottom:15px;">
                        <?php
                        if ($middle_initial==="") {
                            echo $first_name . " " . $last_name;
                        } else {
                            echo $first_name . " " . $middle_initial . ". " . $last_name;
                        }
                        ?>
                    </p>
                    <h4>Instructor Email</h4>
                    <p style="margin-bottom:15px;"><?php echo $email; ?></p>
                    <h4>Office Phone</h4>
                    <p style="margin-bottom:15px;">
                        <?php
                        $phone_1 = substr($office_phone, 0, 3);
                        $phone_2 = substr($office_phone, 3, 3);
                        $phone_3 = substr($office_phone, 6, 4);
                        echo $phone_1 . "-" . $phone_2 . "-" . $phone_3;
                        ?>
                    </p>
                    <h4>Office Location</h4>
                    <p><?php echo $office_location; ?></p>
                </div>
                <div class="col-sm-4">
                    <h4 style="margin-bottom:15px;">Required Textbook</h4>
                    <?php
                        if ($isbn === "") {
                            echo "There is no required textbook for this course.";
                        }
                        else {
                            echo "<strong>Title </strong>" . $textbook_title . "<br>";
                            echo "<strong>Author </strong>" . $author_name . "<br>";
                            echo "<strong>Edition </strong>" . $textbook_edition . "<br>";
                            echo "<strong>Release Year </strong>" . $textbook_release_year . "<br>";
                            echo "<strong>Publisher </strong>" . $publisher_name . "<br>";
                            echo "<strong>ISBN </strong>" . $isbn . "<br>";
                            echo "<a href='https://ncat.bncollege.com' target='_blank'>";
                            echo "<div class='purchase-textbook'>Purchase Textbook</div>";
                            echo "</a>";
                        }
                        ?>

                </div>
            </div>

        </div>

    </body>

</html>
