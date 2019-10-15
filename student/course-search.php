<?php
include '../assets/student/connect.php';

$sql_semester = "SELECT semester_id, semester_title, start_date FROM semester ORDER BY start_date DESC";
$result_semester = $conn->query($sql_semester);

$sql_department = "SELECT department_id, department_name FROM department ORDER BY department_name ASC";
$result_department = $conn->query($sql_department);

$sql_type = "SELECT type_id, type_name FROM course_type ORDER BY type_id ASC";
$result_type = $conn->query($sql_type);

$sql_instructor = "SELECT instructor_id, first_name, last_name FROM instructor ORDER BY last_name ASC";
$result_instructor = $conn->query($sql_instructor);

$sql_level = "SELECT level_id, level_name FROM course_level ORDER BY level_id ASC";
$result_level = $conn->query($sql_level);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Course Search</title>
  <?php include '../assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#course-search").addClass("active");
  });
  </script>
</head>

<body style="margin-bottom:35px;">

  <?php include '../assets/student/navbar.php'; ?>

  <div class="container">

    <h1>Course Search</h1>
    <p style="margin-bottom:35px;">Search for courses by entering your criteria below.</p>

    <form action="search-results.php" method="get">
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label>Semester</label>
            <select class="form-control" name="semester" required>
              <option disabled selected value>Select Semester</option>
              <?php
              while($row_semester = $result_semester->fetch_assoc()) {
                echo "<option value='" . $row_semester['semester_id'] . "'>" . $row_semester['semester_title'] . "</option>";
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
                echo "<option value='" . $row_department['department_id'] . "'>" . $row_department['department_name'] . "</option>";
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
                echo "<option value='" . $row_type['type_id'] . "'>" . $row_type['type_name'] . "</option>";
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
              <option value='1.0'>1.0</option>
              <option value='2.0'>2.0</option>
              <option value='3.0'>3.0</option>
              <option value='4.0'>4.0</option>
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
                echo "<option value='" . $row_instructor['instructor_id'] . "'>" . $row_instructor['first_name'] . " " . $row_instructor['last_name'] . "</option>";
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
                echo "<option value='" . $row_level['level_id'] . "'>" . $row_level['level_name'] . "</option>";
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
              <option value='8'>8:00 AM</option>
              <option value='9'>9:00 AM</option>
              <option value='10'>10:00 AM</option>
              <option value='11'>11:00 AM</option>
              <option value='12'>12:00 PM</option>
              <option value='13'>1:00 PM</option>
              <option value='14'>2:00 PM</option>
              <option value='15'>3:00 PM</option>
              <option value='16'>4:00 PM</option>
              <option value='17'>5:00 PM</option>
              <option value='18'>6:00 PM</option>
              <option value='19'>7:00 PM</option>
              <option value='20'>8:00 PM</option>
            </select>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-default">Submit</button>

    </form>

  </div>

</body>

</html>
