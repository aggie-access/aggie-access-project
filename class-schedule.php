<?php
include 'assets/connect.php';

$banner_id=$_SESSION['username'];

$sql_semester = "SELECT DISTINCT semester.semester_id, semester_title, start_date FROM semester JOIN registration ON (semester.semester_id=registration.semester_id) WHERE banner_id='$banner_id' ORDER BY start_date DESC";
$result_semester = $conn->query($sql_semester);

$semester_id='';
$result_schedule='';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $semester_id=$_POST['semester-id'];
  $sql_schedule = "SELECT subject_abbreviation, course_number, section_number, course_title, credit_hours, first_name, last_name, type_name, meeting_days, start_time, end_time, meeting_location
  FROM registration, section, instructor, course, subject, course_type
  WHERE banner_id='$banner_id' AND section.crn=registration.crn AND section.instructor_id=instructor.instructor_id AND registration.semester_id='$semester_id' AND section.course_id=course.course_id AND course.subject_id=subject.subject_id AND section.type_id=course_type.type_id
  ORDER BY subject_abbreviation ASC, course_number ASC";
  $result_schedule = $conn->query($sql_schedule);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Class Schedule</title>
  <?php include 'assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#class-schedule").addClass("active");
  });
  </script>
</head>

<body>

  <?php include 'assets/navbar.php'; ?>

  <div class="container">

    <h1>Class Schedule</h1>
    <p style="margin-bottom:35px;">Select a semester below to view your class schedule.</p>

    <form method="post">
      <div class="row" style="margin-bottom:10px;">
        <div class="col-sm-6">
          <div class="form-group">
            <?php
            if ($result_semester->num_rows > 0) {
              echo "<select id='semester-id' class='form-control' name='semester-id' onchange='this.form.submit();'>";
              echo "<option disabled selected value>Select Semester</option>";
              while($row_semester = $result_semester->fetch_assoc()) {
                echo "<option ";
                if ($semester_id == $row_semester['semester_id'] ) {
                  echo 'selected ';
                }
                echo "value='" . $row_semester['semester_id'] . "'>" . $row_semester['semester_title'] . "</option>";
              }
              echo "</select>";
            } else {
              echo "You are not registered for any classes.";
            }
            ?>
          </div>
        </div>
      </div>
    </form>

    <?php
    if ($result_schedule->num_rows > 0) {
      echo "<div class='class-schedule-container'>";
      while($row_schedule = $result_schedule->fetch_assoc()) {
        echo "<div class='class-schedule-grid'>
        <div class='row row-no-gutters class-schedule-row'>
        <div class='col-sm-3'>
        <strong>Course</strong>
        </div>
        <div class='col-sm-9'>" . $row_schedule['subject_abbreviation'] . " " . $row_schedule['course_number'] . "</div>
        </div>

        <div class='row row-no-gutters class-schedule-row'>
        <div class='col-sm-3'>
        <strong>Title</strong>
        </div>
        <div class='col-sm-9'>" . $row_schedule['course_title'] . "</div>
        </div>

        <div class='row row-no-gutters class-schedule-row'>
        <div class='col-sm-3'>
        <strong>Credits</strong>
        </div>
        <div class='col-sm-9'>" . $row_schedule['credit_hours'] . "</div>
        </div>

        <div class='row row-no-gutters class-schedule-row'>
        <div class='col-sm-3'>
        <strong>Instructor</strong>
        </div>
        <div class='col-sm-9'>" . $row_schedule['first_name'] . " " . $row_schedule['last_name'] . "</div>
        </div>

        <div class='row row-no-gutters class-schedule-row'>
        <div class='col-sm-3'>
        <strong>Type</strong>
        </div>
        <div class='col-sm-9'>" . $row_schedule['type_name'] . "</div>
        </div>

        <div class='row row-no-gutters class-schedule-row'>
        <div class='col-sm-3'>
        <strong>Days</strong>
        </div>
        <div class='col-sm-9'>";

        if ($row_schedule['meeting_days'] === ""){
          echo "N/A</div>
          </div>
          <div class='row row-no-gutters class-schedule-row'>
          <div class='col-sm-3'>
          <strong>Times</strong>
          </div>
          <div class='col-sm-9'>N/A</div>
          </div>";
        } else {
          echo $row_schedule['meeting_days'] ."</div>
          </div>
          <div class='row row-no-gutters class-schedule-row'>
          <div class='col-sm-3'>
          <strong>Times</strong>
          </div>
          <div class='col-sm-9'>" . date('g:i A', strtotime($row_schedule['start_time'])) . " - " . date('g:i A', strtotime($row_schedule['end_time'])) . "</div>
          </div>";
        }

        echo "<div class='row row-no-gutters class-schedule-row'>
        <div class='col-sm-3'>
        <strong>Location</strong>
        </div>
        <div class='col-sm-9'>" . $row_schedule['meeting_location'] . "</div>
        </div>
        </div>";
      }
      echo "</div>";
    }
    ?>
    
  </div>
</body>
</html>
