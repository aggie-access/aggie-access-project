<?php
include 'assets/connect.php';

$banner_id=$_SESSION['username'];

$sql_student="SELECT level_name, classification_title, college_name, degree_title, major_title
FROM student, course_level, classification, college, degree, major
WHERE banner_id='$banner_id' AND student.level_id=course_level.level_id AND student.classification_id=classification.classification_id AND student.college_id=college.college_id AND student.degree_id=degree.degree_id AND student.major_id=major.major_id";
$result_student = $conn->query($sql_student);
$row_student = $result_student->fetch_assoc();
$level_name=$row_student['level_name'];
$classification_title=$row_student['classification_title'];
$college_name=$row_student['college_name'];
$degree_title=$row_student['degree_title'];
$major_title=$row_student['major_title'];

$sql_semester = "SELECT DISTINCT semester.semester_id, semester_title FROM semester, registration WHERE banner_id='$banner_id' AND semester.semester_id=registration.semester_id ORDER BY start_date DESC";
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
                echo "<select id='semester-id' class='form-control' name='semester-id' onchange='this.form.submit();''>";
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
        "<td>" . $row_schedule['subject_abbreviation'] . " " . $row_schedule['course_number'] . " | " . $row_schedule['section_number'] .  "</td>" .
        "<td>" . $row_schedule['course_title'] . "</td>" .
        "<td>" . $row_schedule['credit_hours'] . "</td>" .
        "<td>" . $row_schedule['first_name'] . " " . $row_schedule['last_name'] .  "</td>" .
        "<td>" . $row_schedule['type_name']. "</td>" ;

        if ($row_schedule['meeting_days'] === "")
        {
          echo "<td>N/A</td>";
          echo "<td>N/A</td>";
        } else {
          echo "<td>" . $row_schedule['meeting_days'] . "</td>" .
          "<td>" . date('g:i A', strtotime($row_schedule['start_time'])) . " - " . date('g:i A', strtotime($row_schedule['end_time'])) .  "</td>";
        }

        echo "<td>" . $row_schedule['meeting_location']. "</td>" .
        "</tr>";
      }

      echo "</tbody>";
      echo "</table>";
      echo "</div>";
    }
    ?>

</div>
</body>
</html>
