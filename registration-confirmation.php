<?php
include 'assets/connect.php';

$semester_id=$_POST['semester'];

$sql_semester = "SELECT semester_title, start_date, finish_date FROM semester WHERE semester_id='$semester_id'";
$result_semester = $conn->query($sql_semester);
$row_semester = $result_semester->fetch_assoc();
$semester_title=$row_semester['semester_title'];
$start_date=date('F j, Y', strtotime($row_semester['start_date']));
$finish_date=date('F j, Y', strtotime($row_semester['finish_date']));

$input_pin=$_POST['pin'];

$banner_id=$_SESSION['username'];

$sql_registration_period="SELECT DATE(NOW()) AS today, start_date, end_date, classification_title
FROM registration_period r JOIN classification c ON (r.classification_id=c.classification_id)
WHERE semester_id='$semester_id' AND c.classification_id=(SELECT classification_id FROM student WHERE banner_id='$banner_id')";
$result_registration_period = $conn->query($sql_registration_period);
$row_registration_period = $result_registration_period->fetch_assoc();
$current_date=$row_registration_period['today'];
$start_date=$row_registration_period['start_date'];
$end_date=$row_registration_period['end_date'];
$classification=$row_registration_period['classification_title'];

$sql_pin = "SELECT registration_pin FROM registration_pin WHERE banner_id='$banner_id' AND semester_id='$semester_id'";
$result_pin = $conn->query($sql_pin);
$row_pin = $result_pin->fetch_assoc();
$registration_pin=$row_pin['registration_pin'];

if ($_POST['crn-1']!='') {
  $crn_1=$_POST['crn-1'];

  $sql_class_1 = "SELECT n.course_id, crn, subject_abbreviation, course_number, section_number, course_title, credit_hours, first_name, last_name, type_name, meeting_days, start_time, end_time, meeting_location
  FROM semester s JOIN section n ON (n.semester_id=s.semester_id) JOIN course c ON (n.course_id=c.course_id) JOIN subject j ON (c.subject_id=j.subject_id) JOIN instructor i ON (n.instructor_id=i.instructor_id) JOIN course_type t ON (n.type_id=t.type_id)
  WHERE crn='$crn_1' AND s.semester_id='$semester_id'";
  $result_class_1 = $conn->query($sql_class_1);
  $row_class_1 = $result_class_1->fetch_assoc();

  $class_1_id=$row_class_1['course_id'];

  $sql_class_1_seats="SELECT (seat_capacity-COUNT(*)) AS seats_available FROM registration r JOIN section s ON (r.crn=s.crn) WHERE r.crn='$crn_1'";
  $result_class_1_seats = $conn->query($sql_class_1_seats);
  $row_class_1_seats = $result_class_1_seats->fetch_assoc();

  if (isset($row_class_1_seats['seats_available'])) {
    $class_1_seats_available=$row_class_1_seats['seats_available'];
  } else {
    $sql_class_1_capacity="SELECT seat_capacity FROM section WHERE crn='$crn_1'";
    $result_class_1_capacity = $conn->query($sql_class_1_capacity);
    $row_class_1_capacity = $result_class_1_capacity->fetch_assoc();

    $class_1_seats_available=$row_class_1_capacity['seat_capacity'];
  }
}

if ($_POST['crn-2']!='') {
  $crn_2=$_POST['crn-2'];

  $sql_class_2 = "SELECT n.course_id, crn, subject_abbreviation, course_number, section_number, course_title, credit_hours, first_name, last_name, type_name, meeting_days, start_time, end_time, meeting_location
  FROM semester s JOIN section n ON (n.semester_id=s.semester_id) JOIN course c ON (n.course_id=c.course_id) JOIN subject j ON (c.subject_id=j.subject_id) JOIN instructor i ON (n.instructor_id=i.instructor_id) JOIN course_type t ON (n.type_id=t.type_id)
  WHERE crn='$crn_2' AND s.semester_id='$semester_id'";
  $result_class_2 = $conn->query($sql_class_2);
  $row_class_2 = $result_class_2->fetch_assoc();

  $class_2_id=$row_class_2['course_id'];

  $sql_class_2_seats="SELECT (seat_capacity-COUNT(*)) AS seats_available FROM registration r JOIN section s ON (r.crn=s.crn) WHERE r.crn='$crn_2'";
  $result_class_2_seats = $conn->query($sql_class_2_seats);
  $row_class_2_seats = $result_class_2_seats->fetch_assoc();

  if ($row_class_2_seats['seats_available']!='') {
    $class_2_seats_available=$row_class_2_seats['seats_available'];
  } else {
    $sql_class_2_capacity="SELECT seat_capacity FROM section WHERE crn='$crn_2'";
    $result_class_2_capacity = $conn->query($sql_class_2_capacity);
    $row_class_2_capacity = $result_class_2_capacity->fetch_assoc();

    $class_2_seats_available=$row_class_2_capacity['seat_capacity'];
  }
}

if ($_POST['crn-3']!='') {
  $crn_3=$_POST['crn-3'];

  $sql_class_3 = "SELECT n.course_id, crn, subject_abbreviation, course_number, section_number, course_title, credit_hours, first_name, last_name, type_name, meeting_days, start_time, end_time, meeting_location
  FROM semester s JOIN section n ON (n.semester_id=s.semester_id) JOIN course c ON (n.course_id=c.course_id) JOIN subject j ON (c.subject_id=j.subject_id) JOIN instructor i ON (n.instructor_id=i.instructor_id) JOIN course_type t ON (n.type_id=t.type_id)
  WHERE crn='$crn_3' AND s.semester_id='$semester_id'";
  $result_class_3 = $conn->query($sql_class_3);
  $row_class_3 = $result_class_3->fetch_assoc();

  $class_3_id=$row_class_3['course_id'];

  $sql_class_3_seats="SELECT (seat_capacity-COUNT(*)) AS seats_available FROM registration r JOIN section s ON (r.crn=s.crn) WHERE r.crn='$crn_3'";
  $result_class_3_seats = $conn->query($sql_class_3_seats);
  $row_class_3_seats = $result_class_3_seats->fetch_assoc();

  if ($row_class_3_seats['seats_available']!='') {
    $class_3_seats_available=$row_class_3_seats['seats_available'];
  } else {
    $sql_class_3_capacity="SELECT seat_capacity FROM section WHERE crn='$crn_3'";
    $result_class_3_capacity = $conn->query($sql_class_3_capacity);
    $row_class_3_capacity = $result_class_3_capacity->fetch_assoc();

    $class_3_seats_available=$row_class_3_capacity['seat_capacity'];
  }
}

if ($_POST['crn-4']!='') {
  $crn_4=$_POST['crn-4'];

  $sql_class_4 = "SELECT n.course_id, crn, subject_abbreviation, course_number, section_number, course_title, credit_hours, first_name, last_name, type_name, meeting_days, start_time, end_time, meeting_location
  FROM semester s JOIN section n ON (n.semester_id=s.semester_id) JOIN course c ON (n.course_id=c.course_id) JOIN subject j ON (c.subject_id=j.subject_id) JOIN instructor i ON (n.instructor_id=i.instructor_id) JOIN course_type t ON (n.type_id=t.type_id)
  WHERE crn='$crn_4' AND s.semester_id='$semester_id'";
  $result_class_4 = $conn->query($sql_class_4);
  $row_class_4 = $result_class_4->fetch_assoc();

  $class_4_id=$row_class_4['course_id'];

  $sql_class_4_seats="SELECT (seat_capacity-COUNT(*)) AS seats_available FROM registration r JOIN section s ON (r.crn=s.crn) WHERE r.crn='$crn_4'";
  $result_class_4_seats = $conn->query($sql_class_4_seats);
  $row_class_4_seats = $result_class_4_seats->fetch_assoc();

  if ($row_class_4_seats['seats_available']!='') {
    $class_4_seats_available=$row_class_4_seats['seats_available'];
  } else {
    $sql_class_4_capacity="SELECT seat_capacity FROM section WHERE crn='$crn_4'";
    $result_class_4_capacity = $conn->query($sql_class_4_capacity);
    $row_class_4_capacity = $result_class_4_capacity->fetch_assoc();

    $class_4_seats_available=$row_class_4_capacity['seat_capacity'];
  }
}

if ($_POST['crn-5']!='') {
  $crn_5=$_POST['crn-5'];

  $sql_class_5 = "SELECT n.course_id, crn, subject_abbreviation, course_number, section_number, course_title, credit_hours, first_name, last_name, type_name, meeting_days, start_time, end_time, meeting_location
  FROM semester s JOIN section n ON (n.semester_id=s.semester_id) JOIN course c ON (n.course_id=c.course_id) JOIN subject j ON (c.subject_id=j.subject_id) JOIN instructor i ON (n.instructor_id=i.instructor_id) JOIN course_type t ON (n.type_id=t.type_id)
  WHERE crn='$crn_5' AND s.semester_id='$semester_id'";
  $result_class_5 = $conn->query($sql_class_5);
  $row_class_5 = $result_class_5->fetch_assoc();

  $class_5_id=$row_class_5['course_id'];

  $sql_class_5_seats="SELECT (seat_capacity-COUNT(*)) AS seats_available FROM registration r JOIN section s ON (r.crn=s.crn) WHERE r.crn='$crn_5'";
  $result_class_5_seats = $conn->query($sql_class_5_seats);
  $row_class_5_seats = $result_class_5_seats->fetch_assoc();

  if ($row_class_5_seats['seats_available']!='') {
    $class_5_seats_available=$row_class_5_seats['seats_available'];
  } else {
    $sql_class_5_capacity="SELECT seat_capacity FROM section WHERE crn='$crn_5'";
    $result_class_5_capacity = $conn->query($sql_class_5_capacity);
    $row_class_5_capacity = $result_class_5_capacity->fetch_assoc();

    $class_5_seats_available=$row_class_5_capacity['seat_capacity'];
  }
}

if ($_POST['crn-6']!='') {
  $crn_6=$_POST['crn-6'];

  $sql_class_6 = "SELECT n.course_id, crn, subject_abbreviation, course_number, section_number, course_title, credit_hours, first_name, last_name, type_name, meeting_days, start_time, end_time, meeting_location
  FROM semester s JOIN section n ON (n.semester_id=s.semester_id) JOIN course c ON (n.course_id=c.course_id) JOIN subject j ON (c.subject_id=j.subject_id) JOIN instructor i ON (n.instructor_id=i.instructor_id) JOIN course_type t ON (n.type_id=t.type_id)
  WHERE crn='$crn_6' AND s.semester_id='$semester_id'";
  $result_class_6 = $conn->query($sql_class_6);
  $row_class_6 = $result_class_6->fetch_assoc();

  $class_6_id=$row_class_6['course_id'];

  $sql_class_6_seats="SELECT (seat_capacity-COUNT(*)) AS seats_available FROM registration r JOIN section s ON (r.crn=s.crn) WHERE r.crn='$crn_6'";
  $result_class_6_seats = $conn->query($sql_class_6_seats);
  $row_class_6_seats = $result_class_6_seats->fetch_assoc();

  if ($row_class_6_seats['seats_available']!='') {
    $class_6_seats_available=$row_class_6_seats['seats_available'];
  } else {
    $sql_class_6_capacity="SELECT seat_capacity FROM section WHERE crn='$crn_6'";
    $result_class_6_capacity = $conn->query($sql_class_6_capacity);
    $row_class_6_capacity = $result_class_6_capacity->fetch_assoc();

    $class_6_seats_available=$row_class_6_capacity['seat_capacity'];
  }
}

$total_credits=$row_class_1['credit_hours']+$row_class_2['credit_hours']+$row_class_3['credit_hours']+$row_class_4['credit_hours']+$row_class_5['credit_hours']+$row_class_6['credit_hours'];

$sql_transcript = "SELECT c.course_id
FROM grading_scale gs JOIN grades g ON (g.letter_grade=gs.letter_grade) JOIN registration r ON (r.registration_id=g.registration_id) JOIN section s ON (r.crn=s.crn) JOIN course c ON (s.course_id=c.course_id)
WHERE banner_id='$banner_id' AND g.letter_grade NOT IN ('C-', 'D+', 'D', 'F', 'U', 'W', 'I', 'AU')";
$result_transcript = $conn->query($sql_transcript);

if ($result_transcript->num_rows > 0) {
  $transcript = array();
  while($row_transcript = $result_transcript->fetch_assoc()) {
    $transcript[] = $row_transcript['course_id'];
  }
}

$sql_registration = "SELECT DISTINCT crn
FROM registration
WHERE banner_id='$banner_id' AND semester_id='$semester_id'";
$result_registration = $conn->query($sql_registration);

if ($result_registration->num_rows > 0) {
  $registration = array();
  while($row_registration = $result_registration->fetch_assoc()) {
    $registration[] = $row_registration['crn'];
  }
}
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
    if ($current_date>=$start_date AND $current_date<=$end_date) {
      if ($registration_pin===$input_pin) {

        if (isset($crn_1)) {
          if(in_array($crn_1, $registration)) {
            echo "<div class='course-registration-container'><div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have already registered for <strong>" . $row_class_1['subject_abbreviation'] . " " . $row_class_1['course_number'] . " " . $row_class_1['section_number'] . "</strong>, so you do not need to register for that course again.</div></div>";
          } else {
            if ($result_class_1->num_rows > 0) {
              if ($class_1_seats_available>0) {
                $sql_coreq_1 = "SELECT corequisite_id
                FROM course c JOIN section s ON (c.course_id=s.course_id)
                WHERE s.crn='$crn_1'";
                $result_coreq_1 = $conn->query($sql_coreq_1);
                $row_coreq_1 = $result_coreq_1->fetch_assoc();

                $coreq_1=$row_coreq_1['corequisite_id'];

                if (isset($coreq_1)) {
                  if ($coreq_1===$class_1_id OR $coreq_1===$class_2_id OR $coreq_1===$class_3_id OR $coreq_1===$class_4_id OR $coreq_1===$class_5_id OR $coreq_1===$class_6_id) {

                    $sql_prereq_1 = "SELECT prerequisite_id
                    FROM course c JOIN section s ON (c.course_id=s.course_id)
                    WHERE s.crn='$crn_1'";
                    $result_prereq_1 = $conn->query($sql_prereq_1);
                    $row_prereq_1 = $result_prereq_1->fetch_assoc();

                    $prereq_1=$row_prereq_1['prerequisite_id'];

                    if (isset($prereq_1)) {
                      if (in_array($prereq_1, $transcript)) {
                        $register_class_1 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_1')");

                        echo "<div class='course-registration-container'>
                        <div class='course-registration-grid'>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>CRN</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_1['crn'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Course</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_1['subject_abbreviation'] . " " . $row_class_1['course_number'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Section</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_1['section_number'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Title</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_1['course_title'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Credits</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_1['credit_hours'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Instructor</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_1['first_name'] . " " . $row_class_1['last_name'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Type</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_1['type_name'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Days</strong>
                        </div>
                        <div class='col-sm-9'>";

                        if ($row_class_1['meeting_days'] === "") {
                          echo "N/A";
                        } else {
                          echo $row_class_1['meeting_days'];
                        }

                        echo "</div>
                        </div>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Times</strong>
                        </div>
                        <div class='col-sm-9'>";

                        if ($row_class_1['meeting_days'] === "") {
                          echo "N/A";
                        } else {
                          echo date('g:i A', strtotime($row_class_1['start_time'])) . " - " . date('g:i A', strtotime($row_class_1['end_time']));
                        }

                        echo "</div>
                        </div>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Location</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_1['meeting_location'] . "</div>
                        </div>
                        </div>";
                      } else {
                        echo "<div class='course-registration-container'><div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not taken the prerequisite for <strong>" . $row_class_1['subject_abbreviation'] . " " . $row_class_1['course_number'] . "</strong>, so you have not been registered for that course.</div></div></div>";
                      }
                    } else {
                      $register_class_1 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_1')");

                      echo "<div class='course-registration-container'>
                      <div class='course-registration-grid'>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>CRN</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['crn'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Course</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['subject_abbreviation'] . " " . $row_class_1['course_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Section</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['section_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Title</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['course_title'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Credits</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['credit_hours'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Instructor</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['first_name'] . " " . $row_class_1['last_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Type</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['type_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Days</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_1['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo $row_class_1['meeting_days'];
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Times</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_1['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo date('g:i A', strtotime($row_class_1['start_time'])) . " - " . date('g:i A', strtotime($row_class_1['end_time']));
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Location</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['meeting_location'] . "</div>
                      </div>
                      </div>";
                    }

                  } else {
                    echo "<div class='course-registration-container'><div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not signed up for the corequisite for <strong>" . $row_class_1['subject_abbreviation'] . " " . $row_class_1['course_number'] . "</strong>, so you have not been registered for that course.</div></div></div>";
                  }
                } else {
                  $sql_prereq_1 = "SELECT prerequisite_id
                  FROM course c JOIN section s ON (c.course_id=s.course_id)
                  WHERE s.crn='$crn_1'";
                  $result_prereq_1 = $conn->query($sql_prereq_1);
                  $row_prereq_1 = $result_prereq_1->fetch_assoc();

                  $prereq_1=$row_prereq_1['prerequisite_id'];

                  if (isset($prereq_1)) {
                    if (in_array($prereq_1, $transcript)) {
                      $register_class_1 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_1')");

                      echo "<div class='course-registration-container'>
                      <div class='course-registration-grid'>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>CRN</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['crn'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Course</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['subject_abbreviation'] . " " . $row_class_1['course_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Section</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['section_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Title</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['course_title'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Credits</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['credit_hours'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Instructor</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['first_name'] . " " . $row_class_1['last_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Type</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['type_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Days</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_1['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo $row_class_1['meeting_days'];
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Times</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_1['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo date('g:i A', strtotime($row_class_1['start_time'])) . " - " . date('g:i A', strtotime($row_class_1['end_time']));
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Location</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_1['meeting_location'] . "</div>
                      </div>
                      </div>";
                    } else {
                      echo "<div class='course-registration-container'><div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not taken the prerequisite for <strong>" . $row_class_1['subject_abbreviation'] . " " . $row_class_1['course_number'] . "</strong>, so you have not been registered for that course.</div></div></div>";
                    }
                  } else {
                    $register_class_1 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_1')");

                    echo "<div class='course-registration-container'>
                    <div class='course-registration-grid'>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>CRN</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_1['crn'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Course</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_1['subject_abbreviation'] . " " . $row_class_1['course_number'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Section</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_1['section_number'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Title</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_1['course_title'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Credits</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_1['credit_hours'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Instructor</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_1['first_name'] . " " . $row_class_1['last_name'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Type</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_1['type_name'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Days</strong>
                    </div>
                    <div class='col-sm-9'>";

                    if ($row_class_1['meeting_days'] === "") {
                      echo "N/A";
                    } else {
                      echo $row_class_1['meeting_days'];
                    }

                    echo "</div>
                    </div>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Times</strong>
                    </div>
                    <div class='col-sm-9'>";

                    if ($row_class_1['meeting_days'] === "") {
                      echo "N/A";
                    } else {
                      echo date('g:i A', strtotime($row_class_1['start_time'])) . " - " . date('g:i A', strtotime($row_class_1['end_time']));
                    }

                    echo "</div>
                    </div>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Location</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_1['meeting_location'] . "</div>
                    </div>
                    </div>";
                  }
                }
              } else {
                echo "<div class='course-registration-container'><div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'><strong>" . $row_class_1['subject_abbreviation'] . " " . $row_class_1['course_number'] . " " . $row_class_1['section_number'] . "</strong> has met its seating capacity, so you cannot register for this class.</div></div></div>";
              }
            } else {
              echo "<div class='course-registration-container'><div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>The course reference number <strong>" . $crn_1 . "</strong> does not match any of the courses being offered during the <strong>" . $semester_title . "</strong> semester.</div></div></div>";
            }
          }
        }

        if (isset($crn_2)) {
          if(in_array($crn_2, $registration)) {
            echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have already registered for <strong>" . $row_class_2['subject_abbreviation'] . " " . $row_class_2['course_number'] . " " . $row_class_2['section_number'] . "</strong>, so you do not need to register for that course again.</div></div>";
          } else {
            if ($result_class_2->num_rows > 0) {
              if ($class_2_seats_available>0) {
                $sql_coreq_2 = "SELECT corequisite_id
                FROM course c JOIN section s ON (c.course_id=s.course_id)
                WHERE s.crn='$crn_2'";
                $result_coreq_2 = $conn->query($sql_coreq_2);
                $row_coreq_2 = $result_coreq_2->fetch_assoc();

                $coreq_2=$row_coreq_2['corequisite_id'];

                if (isset($coreq_2)) {
                  if ($coreq_2===$class_1_id OR $coreq_2===$class_2_id OR $coreq_2===$class_3_id OR $coreq_2===$class_4_id OR $coreq_2===$class_5_id OR $coreq_2===$class_6_id) {

                    $sql_prereq_2 = "SELECT prerequisite_id
                    FROM course c JOIN section s ON (c.course_id=s.course_id)
                    WHERE s.crn='$crn_2'";
                    $result_prereq_2 = $conn->query($sql_prereq_2);
                    $row_prereq_2 = $result_prereq_2->fetch_assoc();

                    $prereq_2=$row_prereq_2['prerequisite_id'];

                    if (isset($prereq_2)) {
                      if (in_array($prereq_2, $transcript)) {
                        $register_class_2 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_2')");

                        echo "<div class='course-registration-grid'>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>CRN</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_2['crn'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Course</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_2['subject_abbreviation'] . " " . $row_class_2['course_number'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Section</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_2['section_number'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Title</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_2['course_title'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Credits</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_2['credit_hours'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Instructor</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_2['first_name'] . " " . $row_class_2['last_name'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Type</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_2['type_name'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Days</strong>
                        </div>
                        <div class='col-sm-9'>";

                        if ($row_class_2['meeting_days'] === "") {
                          echo "N/A";
                        } else {
                          echo $row_class_2['meeting_days'];
                        }

                        echo "</div>
                        </div>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Times</strong>
                        </div>
                        <div class='col-sm-9'>";

                        if ($row_class_2['meeting_days'] === "") {
                          echo "N/A";
                        } else {
                          echo date('g:i A', strtotime($row_class_2['start_time'])) . " - " . date('g:i A', strtotime($row_class_2['end_time']));
                        }

                        echo "</div>
                        </div>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Location</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_2['meeting_location'] . "</div>
                        </div>
                        </div>";
                      } else {
                        echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not taken the prerequisite for <strong>" . $row_class_2['subject_abbreviation'] . " " . $row_class_2['course_number'] . "</strong>, so you have not been registered for that course.</div></div>";
                      }
                    } else {
                      $register_class_2 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_2')");

                      echo "<div class='course-registration-grid'>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>CRN</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['crn'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Course</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['subject_abbreviation'] . " " . $row_class_2['course_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Section</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['section_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Title</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['course_title'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Credits</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['credit_hours'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Instructor</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['first_name'] . " " . $row_class_2['last_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Type</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['type_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Days</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_2['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo $row_class_2['meeting_days'];
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Times</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_2['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo date('g:i A', strtotime($row_class_2['start_time'])) . " - " . date('g:i A', strtotime($row_class_2['end_time']));
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Location</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['meeting_location'] . "</div>
                      </div>
                      </div>";
                    }

                  } else {
                    echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not signed up for the corequisite for <strong>" . $row_class_2['subject_abbreviation'] . " " . $row_class_2['course_number'] . "</strong>, so you have not been registered for that course.</div></div>";
                  }
                } else {
                  $sql_prereq_2 = "SELECT prerequisite_id
                  FROM course c JOIN section s ON (c.course_id=s.course_id)
                  WHERE s.crn='$crn_2'";
                  $result_prereq_2 = $conn->query($sql_prereq_2);
                  $row_prereq_2 = $result_prereq_2->fetch_assoc();

                  $prereq_2=$row_prereq_2['prerequisite_id'];

                  if (isset($prereq_2)) {
                    if (in_array($prereq_2, $transcript)) {
                      $register_class_2 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_2')");

                      echo "<div class='course-registration-grid'>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>CRN</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['crn'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Course</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['subject_abbreviation'] . " " . $row_class_2['course_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Section</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['section_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Title</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['course_title'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Credits</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['credit_hours'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Instructor</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['first_name'] . " " . $row_class_2['last_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Type</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['type_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Days</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_2['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo $row_class_2['meeting_days'];
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Times</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_2['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo date('g:i A', strtotime($row_class_2['start_time'])) . " - " . date('g:i A', strtotime($row_class_2['end_time']));
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Location</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_2['meeting_location'] . "</div>
                      </div>
                      </div>";
                    } else {
                      echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not taken the prerequisite for <strong>" . $row_class_2['subject_abbreviation'] . " " . $row_class_2['course_number'] . "</strong>, so you have not been registered for that course.</div></div>";
                    }
                  } else {
                    $register_class_2 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_2')");

                    echo "<div class='course-registration-grid'>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>CRN</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_2['crn'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Course</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_2['subject_abbreviation'] . " " . $row_class_2['course_number'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Section</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_2['section_number'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Title</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_2['course_title'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Credits</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_2['credit_hours'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Instructor</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_2['first_name'] . " " . $row_class_2['last_name'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Type</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_2['type_name'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Days</strong>
                    </div>
                    <div class='col-sm-9'>";

                    if ($row_class_2['meeting_days'] === "") {
                      echo "N/A";
                    } else {
                      echo $row_class_2['meeting_days'];
                    }

                    echo "</div>
                    </div>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Times</strong>
                    </div>
                    <div class='col-sm-9'>";

                    if ($row_class_2['meeting_days'] === "") {
                      echo "N/A";
                    } else {
                      echo date('g:i A', strtotime($row_class_2['start_time'])) . " - " . date('g:i A', strtotime($row_class_2['end_time']));
                    }

                    echo "</div>
                    </div>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Location</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_2['meeting_location'] . "</div>
                    </div>
                    </div>";
                  }
                }
              } else {
                echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'><strong>" . $row_class_2['subject_abbreviation'] . " " . $row_class_2['course_number'] . " " . $row_class_2['section_number'] . "</strong> has met its seating capacity, so you cannot register for this class.</div></div>";
              }
            } else {
              echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>The course reference number <strong>" . $crn_2 . "</strong> does not match any of the courses being offered during the <strong>" . $semester_title . "</strong> semester.</div></div>";
            }
          }
        }

        if (isset($crn_3)) {
          if(in_array($crn_3, $registration)) {
            echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have already registered for <strong>" . $row_class_3['subject_abbreviation'] . " " . $row_class_3['course_number'] . " " . $row_class_3['section_number'] . "</strong>, so you do not need to register for that course again.</div></div>";
          } else {
            if ($result_class_3->num_rows > 0) {
              if ($class_3_seats_available>0) {
                $sql_coreq_3 = "SELECT corequisite_id
                FROM course c JOIN section s ON (c.course_id=s.course_id)
                WHERE s.crn='$crn_3'";
                $result_coreq_3 = $conn->query($sql_coreq_3);
                $row_coreq_3 = $result_coreq_3->fetch_assoc();

                $coreq_3=$row_coreq_3['corequisite_id'];

                if (isset($coreq_3)) {
                  if ($coreq_3===$class_1_id OR $coreq_3===$class_2_id OR $coreq_3===$class_3_id OR $coreq_3===$class_4_id OR $coreq_3===$class_5_id OR $coreq_3===$class_6_id) {

                    $sql_prereq_3 = "SELECT prerequisite_id
                    FROM course c JOIN section s ON (c.course_id=s.course_id)
                    WHERE s.crn='$crn_3'";
                    $result_prereq_3 = $conn->query($sql_prereq_3);
                    $row_prereq_3 = $result_prereq_3->fetch_assoc();

                    $prereq_3=$row_prereq_3['prerequisite_id'];

                    if (isset($prereq_3)) {
                      if (in_array($prereq_3, $transcript)) {
                        $register_class_3 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_3')");

                        echo "<div class='course-registration-grid'>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>CRN</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_3['crn'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Course</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_3['subject_abbreviation'] . " " . $row_class_3['course_number'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Section</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_3['section_number'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Title</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_3['course_title'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Credits</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_3['credit_hours'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Instructor</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_3['first_name'] . " " . $row_class_3['last_name'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Type</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_3['type_name'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Days</strong>
                        </div>
                        <div class='col-sm-9'>";

                        if ($row_class_3['meeting_days'] === "") {
                          echo "N/A";
                        } else {
                          echo $row_class_3['meeting_days'];
                        }

                        echo "</div>
                        </div>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Times</strong>
                        </div>
                        <div class='col-sm-9'>";

                        if ($row_class_3['meeting_days'] === "") {
                          echo "N/A";
                        } else {
                          echo date('g:i A', strtotime($row_class_3['start_time'])) . " - " . date('g:i A', strtotime($row_class_3['end_time']));
                        }

                        echo "</div>
                        </div>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Location</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_3['meeting_location'] . "</div>
                        </div>
                        </div>";
                      } else {
                        echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not taken the prerequisite for <strong>" . $row_class_3['subject_abbreviation'] . " " . $row_class_3['course_number'] . "</strong>, so you have not been registered for that course.</div></div>";
                      }
                    } else {
                      $register_class_3 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_3')");

                      echo "<div class='course-registration-grid'>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>CRN</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['crn'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Course</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['subject_abbreviation'] . " " . $row_class_3['course_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Section</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['section_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Title</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['course_title'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Credits</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['credit_hours'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Instructor</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['first_name'] . " " . $row_class_3['last_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Type</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['type_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Days</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_3['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo $row_class_3['meeting_days'];
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Times</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_3['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo date('g:i A', strtotime($row_class_3['start_time'])) . " - " . date('g:i A', strtotime($row_class_3['end_time']));
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Location</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['meeting_location'] . "</div>
                      </div>
                      </div>";
                    }

                  } else {
                    echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not signed up for the corequisite for <strong>" . $row_class_3['subject_abbreviation'] . " " . $row_class_3['course_number'] . "</strong>, so you have not been registered for that course.</div></div>";
                  }
                } else {
                  $sql_prereq_3 = "SELECT prerequisite_id
                  FROM course c JOIN section s ON (c.course_id=s.course_id)
                  WHERE s.crn='$crn_3'";
                  $result_prereq_3 = $conn->query($sql_prereq_3);
                  $row_prereq_3 = $result_prereq_3->fetch_assoc();

                  $prereq_3=$row_prereq_3['prerequisite_id'];

                  if (isset($prereq_3)) {
                    if (in_array($prereq_3, $transcript)) {
                      $register_class_3 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_3')");

                      echo "<div class='course-registration-grid'>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>CRN</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['crn'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Course</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['subject_abbreviation'] . " " . $row_class_3['course_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Section</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['section_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Title</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['course_title'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Credits</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['credit_hours'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Instructor</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['first_name'] . " " . $row_class_3['last_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Type</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['type_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Days</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_3['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo $row_class_3['meeting_days'];
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Times</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_3['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo date('g:i A', strtotime($row_class_3['start_time'])) . " - " . date('g:i A', strtotime($row_class_3['end_time']));
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Location</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_3['meeting_location'] . "</div>
                      </div>
                      </div>";
                    } else {
                      echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not taken the prerequisite for <strong>" . $row_class_3['subject_abbreviation'] . " " . $row_class_3['course_number'] . "</strong>, so you have not been registered for that course.</div></div>";
                    }
                  } else {
                    $register_class_3 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_3')");

                    echo "<div class='course-registration-grid'>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>CRN</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_3['crn'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Course</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_3['subject_abbreviation'] . " " . $row_class_3['course_number'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Section</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_3['section_number'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Title</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_3['course_title'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Credits</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_3['credit_hours'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Instructor</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_3['first_name'] . " " . $row_class_3['last_name'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Type</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_3['type_name'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Days</strong>
                    </div>
                    <div class='col-sm-9'>";

                    if ($row_class_3['meeting_days'] === "") {
                      echo "N/A";
                    } else {
                      echo $row_class_3['meeting_days'];
                    }

                    echo "</div>
                    </div>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Times</strong>
                    </div>
                    <div class='col-sm-9'>";

                    if ($row_class_3['meeting_days'] === "") {
                      echo "N/A";
                    } else {
                      echo date('g:i A', strtotime($row_class_3['start_time'])) . " - " . date('g:i A', strtotime($row_class_3['end_time']));
                    }

                    echo "</div>
                    </div>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Location</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_3['meeting_location'] . "</div>
                    </div>
                    </div>";
                  }
                }
              } else {
                echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'><strong>" . $row_class_3['subject_abbreviation'] . " " . $row_class_3['course_number'] . " " . $row_class_3['section_number'] . "</strong> has met its seating capacity, so you cannot register for this class.</div></div>";
              }
            } else {
              echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>The course reference number <strong>" . $crn_3 . "</strong> does not match any of the courses being offered during the <strong>" . $semester_title . "</strong> semester.</div></div>";
            }
          }
        }

        if (isset($crn_4)) {
          if(in_array($crn_4, $registration)) {
            echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have already registered for <strong>" . $row_class_4['subject_abbreviation'] . " " . $row_class_4['course_number'] . " " . $row_class_4['section_number'] . "</strong>, so you do not need to register for that course again.</div></div>";
          } else {
            if ($result_class_4->num_rows > 0) {
              if ($class_4_seats_available>0) {
                $sql_coreq_4 = "SELECT corequisite_id
                FROM course c JOIN section s ON (c.course_id=s.course_id)
                WHERE s.crn='$crn_4'";
                $result_coreq_4 = $conn->query($sql_coreq_4);
                $row_coreq_4 = $result_coreq_4->fetch_assoc();

                $coreq_4=$row_coreq_4['corequisite_id'];

                if (isset($coreq_4)) {
                  if ($coreq_4===$class_1_id OR $coreq_4===$class_2_id OR $coreq_4===$class_3_id OR $coreq_4===$class_4_id OR $coreq_4===$class_5_id OR $coreq_4===$class_6_id) {

                    $sql_prereq_4 = "SELECT prerequisite_id
                    FROM course c JOIN section s ON (c.course_id=s.course_id)
                    WHERE s.crn='$crn_4'";
                    $result_prereq_4 = $conn->query($sql_prereq_4);
                    $row_prereq_4 = $result_prereq_4->fetch_assoc();

                    $prereq_4=$row_prereq_4['prerequisite_id'];

                    if (isset($prereq_4)) {
                      if (in_array($prereq_4, $transcript)) {
                        $register_class_4 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_4')");

                        echo "<div class='course-registration-grid'>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>CRN</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_4['crn'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Course</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_4['subject_abbreviation'] . " " . $row_class_4['course_number'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Section</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_4['section_number'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Title</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_4['course_title'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Credits</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_4['credit_hours'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Instructor</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_4['first_name'] . " " . $row_class_4['last_name'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Type</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_4['type_name'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Days</strong>
                        </div>
                        <div class='col-sm-9'>";

                        if ($row_class_4['meeting_days'] === "") {
                          echo "N/A";
                        } else {
                          echo $row_class_4['meeting_days'];
                        }

                        echo "</div>
                        </div>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Times</strong>
                        </div>
                        <div class='col-sm-9'>";

                        if ($row_class_4['meeting_days'] === "") {
                          echo "N/A";
                        } else {
                          echo date('g:i A', strtotime($row_class_4['start_time'])) . " - " . date('g:i A', strtotime($row_class_4['end_time']));
                        }

                        echo "</div>
                        </div>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Location</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_4['meeting_location'] . "</div>
                        </div>
                        </div>";
                      } else {
                        echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not taken the prerequisite for <strong>" . $row_class_4['subject_abbreviation'] . " " . $row_class_4['course_number'] . "</strong>, so you have not been registered for that course.</div></div>";
                      }
                    } else {
                      $register_class_4 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_4')");

                      echo "<div class='course-registration-grid'>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>CRN</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['crn'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Course</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['subject_abbreviation'] . " " . $row_class_4['course_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Section</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['section_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Title</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['course_title'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Credits</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['credit_hours'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Instructor</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['first_name'] . " " . $row_class_4['last_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Type</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['type_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Days</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_4['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo $row_class_4['meeting_days'];
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Times</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_4['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo date('g:i A', strtotime($row_class_4['start_time'])) . " - " . date('g:i A', strtotime($row_class_4['end_time']));
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Location</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['meeting_location'] . "</div>
                      </div>
                      </div>";
                    }

                  } else {
                    echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not signed up for the corequisite for <strong>" . $row_class_4['subject_abbreviation'] . " " . $row_class_4['course_number'] . "</strong>, so you have not been registered for that course.</div></div>";
                  }
                } else {
                  $sql_prereq_4 = "SELECT prerequisite_id
                  FROM course c JOIN section s ON (c.course_id=s.course_id)
                  WHERE s.crn='$crn_4'";
                  $result_prereq_4 = $conn->query($sql_prereq_4);
                  $row_prereq_4 = $result_prereq_4->fetch_assoc();

                  $prereq_4=$row_prereq_4['prerequisite_id'];

                  if (isset($prereq_4)) {
                    if (in_array($prereq_4, $transcript)) {
                      $register_class_4 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_4')");

                      echo "<div class='course-registration-grid'>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>CRN</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['crn'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Course</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['subject_abbreviation'] . " " . $row_class_4['course_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Section</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['section_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Title</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['course_title'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Credits</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['credit_hours'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Instructor</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['first_name'] . " " . $row_class_4['last_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Type</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['type_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Days</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_4['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo $row_class_4['meeting_days'];
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Times</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_4['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo date('g:i A', strtotime($row_class_4['start_time'])) . " - " . date('g:i A', strtotime($row_class_4['end_time']));
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Location</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_4['meeting_location'] . "</div>
                      </div>
                      </div>";
                    } else {
                      echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not taken the prerequisite for <strong>" . $row_class_4['subject_abbreviation'] . " " . $row_class_4['course_number'] . "</strong>, so you have not been registered for that course.</div></div>";
                    }
                  } else {
                    $register_class_4 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_4')");

                    echo "<div class='course-registration-grid'>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>CRN</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_4['crn'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Course</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_4['subject_abbreviation'] . " " . $row_class_4['course_number'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Section</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_4['section_number'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Title</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_4['course_title'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Credits</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_4['credit_hours'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Instructor</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_4['first_name'] . " " . $row_class_4['last_name'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Type</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_4['type_name'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Days</strong>
                    </div>
                    <div class='col-sm-9'>";

                    if ($row_class_4['meeting_days'] === "") {
                      echo "N/A";
                    } else {
                      echo $row_class_4['meeting_days'];
                    }

                    echo "</div>
                    </div>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Times</strong>
                    </div>
                    <div class='col-sm-9'>";

                    if ($row_class_4['meeting_days'] === "") {
                      echo "N/A";
                    } else {
                      echo date('g:i A', strtotime($row_class_4['start_time'])) . " - " . date('g:i A', strtotime($row_class_4['end_time']));
                    }

                    echo "</div>
                    </div>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Location</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_4['meeting_location'] . "</div>
                    </div>
                    </div>";
                  }
                }
              } else {
                echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'><strong>" . $row_class_4['subject_abbreviation'] . " " . $row_class_4['course_number'] . " " . $row_class_4['section_number'] . "</strong> has met its seating capacity, so you cannot register for this class.</div></div>";
              }
            } else {
              echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>The course reference number <strong>" . $crn_4 . "</strong> does not match any of the courses being offered during the <strong>" . $semester_title . "</strong> semester.</div></div>";
            }
          }
        }

        if (isset($crn_5)) {
          if(in_array($crn_5, $registration)) {
            echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have already registered for <strong>" . $row_class_5['subject_abbreviation'] . " " . $row_class_5['course_number'] . " " . $row_class_5['section_number'] . "</strong>, so you do not need to register for that course again.</div></div>";
          } else {
            if ($result_class_5->num_rows > 0) {
              if ($class_5_seats_available>0) {
                $sql_coreq_5 = "SELECT corequisite_id
                FROM course c JOIN section s ON (c.course_id=s.course_id)
                WHERE s.crn='$crn_5'";
                $result_coreq_5 = $conn->query($sql_coreq_5);
                $row_coreq_5 = $result_coreq_5->fetch_assoc();

                $coreq_5=$row_coreq_5['corequisite_id'];

                if (isset($coreq_5)) {
                  if ($coreq_5===$class_1_id OR $coreq_5===$class_2_id OR $coreq_5===$class_3_id OR $coreq_5===$class_4_id OR $coreq_5===$class_5_id OR $coreq_5===$class_6_id) {

                    $sql_prereq_5 = "SELECT prerequisite_id
                    FROM course c JOIN section s ON (c.course_id=s.course_id)
                    WHERE s.crn='$crn_5'";
                    $result_prereq_5 = $conn->query($sql_prereq_5);
                    $row_prereq_5 = $result_prereq_5->fetch_assoc();

                    $prereq_5=$row_prereq_5['prerequisite_id'];

                    if (isset($prereq_5)) {
                      if (in_array($prereq_5, $transcript)) {
                        $register_class_5 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_5')");

                        echo "<div class='course-registration-grid'>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>CRN</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_5['crn'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Course</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_5['subject_abbreviation'] . " " . $row_class_5['course_number'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Section</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_5['section_number'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Title</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_5['course_title'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Credits</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_5['credit_hours'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Instructor</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_5['first_name'] . " " . $row_class_5['last_name'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Type</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_5['type_name'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Days</strong>
                        </div>
                        <div class='col-sm-9'>";

                        if ($row_class_5['meeting_days'] === "") {
                          echo "N/A";
                        } else {
                          echo $row_class_5['meeting_days'];
                        }

                        echo "</div>
                        </div>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Times</strong>
                        </div>
                        <div class='col-sm-9'>";

                        if ($row_class_5['meeting_days'] === "") {
                          echo "N/A";
                        } else {
                          echo date('g:i A', strtotime($row_class_5['start_time'])) . " - " . date('g:i A', strtotime($row_class_5['end_time']));
                        }

                        echo "</div>
                        </div>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Location</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_5['meeting_location'] . "</div>
                        </div>
                        </div>";
                      } else {
                        echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not taken the prerequisite for <strong>" . $row_class_5['subject_abbreviation'] . " " . $row_class_5['course_number'] . "</strong>, so you have not been registered for that course.</div></div>";
                      }
                    } else {
                      $register_class_5 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_5')");

                      echo "<div class='course-registration-grid'>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>CRN</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['crn'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Course</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['subject_abbreviation'] . " " . $row_class_5['course_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Section</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['section_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Title</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['course_title'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Credits</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['credit_hours'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Instructor</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['first_name'] . " " . $row_class_5['last_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Type</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['type_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Days</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_5['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo $row_class_5['meeting_days'];
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Times</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_5['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo date('g:i A', strtotime($row_class_5['start_time'])) . " - " . date('g:i A', strtotime($row_class_5['end_time']));
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Location</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['meeting_location'] . "</div>
                      </div>
                      </div>";
                    }

                  } else {
                    echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not signed up for the corequisite for <strong>" . $row_class_5['subject_abbreviation'] . " " . $row_class_5['course_number'] . "</strong>, so you have not been registered for that course.</div></div>";
                  }
                } else {
                  $sql_prereq_5 = "SELECT prerequisite_id
                  FROM course c JOIN section s ON (c.course_id=s.course_id)
                  WHERE s.crn='$crn_5'";
                  $result_prereq_5 = $conn->query($sql_prereq_5);
                  $row_prereq_5 = $result_prereq_5->fetch_assoc();

                  $prereq_5=$row_prereq_5['prerequisite_id'];

                  if (isset($prereq_5)) {
                    if (in_array($prereq_5, $transcript)) {
                      $register_class_5 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_5')");

                      echo "<div class='course-registration-grid'>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>CRN</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['crn'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Course</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['subject_abbreviation'] . " " . $row_class_5['course_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Section</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['section_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Title</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['course_title'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Credits</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['credit_hours'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Instructor</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['first_name'] . " " . $row_class_5['last_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Type</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['type_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Days</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_5['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo $row_class_5['meeting_days'];
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Times</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_5['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo date('g:i A', strtotime($row_class_5['start_time'])) . " - " . date('g:i A', strtotime($row_class_5['end_time']));
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Location</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_5['meeting_location'] . "</div>
                      </div>
                      </div>";
                    } else {
                      echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not taken the prerequisite for <strong>" . $row_class_5['subject_abbreviation'] . " " . $row_class_5['course_number'] . "</strong>, so you have not been registered for that course.</div></div>";
                    }
                  } else {
                    $register_class_5 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_5')");

                    echo "<div class='course-registration-grid'>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>CRN</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_5['crn'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Course</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_5['subject_abbreviation'] . " " . $row_class_5['course_number'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Section</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_5['section_number'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Title</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_5['course_title'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Credits</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_5['credit_hours'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Instructor</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_5['first_name'] . " " . $row_class_5['last_name'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Type</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_5['type_name'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Days</strong>
                    </div>
                    <div class='col-sm-9'>";

                    if ($row_class_5['meeting_days'] === "") {
                      echo "N/A";
                    } else {
                      echo $row_class_5['meeting_days'];
                    }

                    echo "</div>
                    </div>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Times</strong>
                    </div>
                    <div class='col-sm-9'>";

                    if ($row_class_5['meeting_days'] === "") {
                      echo "N/A";
                    } else {
                      echo date('g:i A', strtotime($row_class_5['start_time'])) . " - " . date('g:i A', strtotime($row_class_5['end_time']));
                    }

                    echo "</div>
                    </div>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Location</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_5['meeting_location'] . "</div>
                    </div>
                    </div>";
                  }
                }
              } else {
                echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'><strong>" . $row_class_5['subject_abbreviation'] . " " . $row_class_5['course_number'] . " " . $row_class_5['section_number'] . "</strong> has met its seating capacity, so you cannot register for this class.</div></div>";
              }
            } else {
              echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>The course reference number <strong>" . $crn_5 . "</strong> does not match any of the courses being offered during the <strong>" . $semester_title . "</strong> semester.</div></div>";
            }
          }
        }

        if (isset($crn_6)) {
          if(in_array($crn_6, $registration)) {
            echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have already registered for <strong>" . $row_class_6['subject_abbreviation'] . " " . $row_class_6['course_number'] . " " . $row_class_6['section_number'] . "</strong>, so you do not need to register for that course again.</div></div>";
          } else {
            if ($result_class_6->num_rows > 0) {
              if ($class_6_seats_available>0) {
                $sql_coreq_6 = "SELECT corequisite_id
                FROM course c JOIN section s ON (c.course_id=s.course_id)
                WHERE s.crn='$crn_6'";
                $result_coreq_6 = $conn->query($sql_coreq_6);
                $row_coreq_6 = $result_coreq_6->fetch_assoc();

                $coreq_6=$row_coreq_6['corequisite_id'];

                if (isset($coreq_6)) {
                  if ($coreq_6===$class_1_id OR $coreq_6===$class_2_id OR $coreq_6===$class_3_id OR $coreq_6===$class_4_id OR $coreq_6===$class_5_id OR $coreq_6===$class_6_id) {

                    $sql_prereq_6 = "SELECT prerequisite_id
                    FROM course c JOIN section s ON (c.course_id=s.course_id)
                    WHERE s.crn='$crn_6'";
                    $result_prereq_6 = $conn->query($sql_prereq_6);
                    $row_prereq_6 = $result_prereq_6->fetch_assoc();

                    $prereq_6=$row_prereq_6['prerequisite_id'];

                    if (isset($prereq_6)) {
                      if (in_array($prereq_6, $transcript)) {
                        $register_class_6 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_6')");

                        echo "<div class='course-registration-grid'>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>CRN</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_6['crn'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Course</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_6['subject_abbreviation'] . " " . $row_class_6['course_number'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Section</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_6['section_number'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Title</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_6['course_title'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Credits</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_6['credit_hours'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Instructor</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_6['first_name'] . " " . $row_class_6['last_name'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Type</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_6['type_name'] . "</div>
                        </div>

                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Days</strong>
                        </div>
                        <div class='col-sm-9'>";

                        if ($row_class_6['meeting_days'] === "") {
                          echo "N/A";
                        } else {
                          echo $row_class_6['meeting_days'];
                        }

                        echo "</div>
                        </div>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Times</strong>
                        </div>
                        <div class='col-sm-9'>";

                        if ($row_class_6['meeting_days'] === "") {
                          echo "N/A";
                        } else {
                          echo date('g:i A', strtotime($row_class_6['start_time'])) . " - " . date('g:i A', strtotime($row_class_6['end_time']));
                        }

                        echo "</div>
                        </div>
                        <div class='row row-no-gutters course-registration-row'>
                        <div class='col-sm-3'>
                        <strong>Meeting Location</strong>
                        </div>
                        <div class='col-sm-9'>" . $row_class_6['meeting_location'] . "</div>
                        </div>
                        </div>";
                      } else {
                        echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not taken the prerequisite for <strong>" . $row_class_6['subject_abbreviation'] . " " . $row_class_6['course_number'] . "</strong>, so you have not been registered for that course.</div></div>";
                      }
                    } else {
                      $register_class_6 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_6')");

                      echo "<div class='course-registration-grid'>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>CRN</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['crn'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Course</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['subject_abbreviation'] . " " . $row_class_6['course_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Section</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['section_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Title</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['course_title'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Credits</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['credit_hours'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Instructor</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['first_name'] . " " . $row_class_6['last_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Type</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['type_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Days</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_6['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo $row_class_6['meeting_days'];
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Times</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_6['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo date('g:i A', strtotime($row_class_6['start_time'])) . " - " . date('g:i A', strtotime($row_class_6['end_time']));
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Location</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['meeting_location'] . "</div>
                      </div>
                      </div>";
                    }

                  } else {
                    echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not signed up for the corequisite for <strong>" . $row_class_6['subject_abbreviation'] . " " . $row_class_6['course_number'] . "</strong>, so you have not been registered for that course.</div></div>";
                  }
                } else {
                  $sql_prereq_6 = "SELECT prerequisite_id
                  FROM course c JOIN section s ON (c.course_id=s.course_id)
                  WHERE s.crn='$crn_6'";
                  $result_prereq_6 = $conn->query($sql_prereq_6);
                  $row_prereq_6 = $result_prereq_6->fetch_assoc();

                  $prereq_6=$row_prereq_6['prerequisite_id'];

                  if (isset($prereq_6)) {
                    if (in_array($prereq_6, $transcript)) {
                      $register_class_6 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_6')");

                      echo "<div class='course-registration-grid'>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>CRN</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['crn'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Course</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['subject_abbreviation'] . " " . $row_class_6['course_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Section</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['section_number'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Title</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['course_title'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Credits</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['credit_hours'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Instructor</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['first_name'] . " " . $row_class_6['last_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Type</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['type_name'] . "</div>
                      </div>

                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Days</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_6['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo $row_class_6['meeting_days'];
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Times</strong>
                      </div>
                      <div class='col-sm-9'>";

                      if ($row_class_6['meeting_days'] === "") {
                        echo "N/A";
                      } else {
                        echo date('g:i A', strtotime($row_class_6['start_time'])) . " - " . date('g:i A', strtotime($row_class_6['end_time']));
                      }

                      echo "</div>
                      </div>
                      <div class='row row-no-gutters course-registration-row'>
                      <div class='col-sm-3'>
                      <strong>Meeting Location</strong>
                      </div>
                      <div class='col-sm-9'>" . $row_class_6['meeting_location'] . "</div>
                      </div>
                      </div>";
                    } else {
                      echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>You have not taken the prerequisite for <strong>" . $row_class_6['subject_abbreviation'] . " " . $row_class_6['course_number'] . "</strong>, so you have not been registered for that course.</div></div>";
                    }
                  } else {
                    $register_class_6 = mysqli_query($conn, "INSERT INTO registration(banner_id, semester_id, crn) VALUES('$banner_id', '$semester_id', '$crn_6')");

                    echo "<div class='course-registration-grid'>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>CRN</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_6['crn'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Course</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_6['subject_abbreviation'] . " " . $row_class_6['course_number'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Section</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_6['section_number'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Title</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_6['course_title'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Credits</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_6['credit_hours'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Instructor</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_6['first_name'] . " " . $row_class_6['last_name'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Type</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_6['type_name'] . "</div>
                    </div>

                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Days</strong>
                    </div>
                    <div class='col-sm-9'>";

                    if ($row_class_6['meeting_days'] === "") {
                      echo "N/A";
                    } else {
                      echo $row_class_6['meeting_days'];
                    }

                    echo "</div>
                    </div>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Times</strong>
                    </div>
                    <div class='col-sm-9'>";

                    if ($row_class_6['meeting_days'] === "") {
                      echo "N/A";
                    } else {
                      echo date('g:i A', strtotime($row_class_6['start_time'])) . " - " . date('g:i A', strtotime($row_class_6['end_time']));
                    }

                    echo "</div>
                    </div>
                    <div class='row row-no-gutters course-registration-row'>
                    <div class='col-sm-3'>
                    <strong>Meeting Location</strong>
                    </div>
                    <div class='col-sm-9'>" . $row_class_6['meeting_location'] . "</div>
                    </div>
                    </div>";
                  }
                }
              } else {
                echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'><strong>" . $row_class_6['subject_abbreviation'] . " " . $row_class_6['course_number'] . " " . $row_class_6['section_number'] . "</strong> has met its seating capacity, so you cannot register for this class.</div></div>";
              }
            } else {
              echo "<div class='course-registration-grid'><div class='row row-no-gutters course-registration-row'>The course reference number <strong>" . $crn_6 . "</strong> does not match any of the courses being offered during the <strong>" . $semester_title . "</strong> semester.</div></div>";
            }
          }
        }

        echo "</div>";

      } else {
        echo "<p style='margin-top:20px;'>The registration PIN that you have provided for the <strong>" . $semester_title . "</strong> semester is invalid.</p>";
      }
    } else {
      echo "You are not allowed to register for classes during the <strong>" . $semester_title . "</strong> semester at this time. Based on your <strong>" . $classification . "</strong> classification, your registration period for the <strong>" . $semester_title . "</strong> semester begins on <strong>" . date('F j, Y', strtotime($start_date)) . "</strong> and ends on <strong>" . date('F j, Y', strtotime($end_date)) . "</strong>.";
    }
    ?>

  </div>

</body>

</html>
