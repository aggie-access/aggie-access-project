<?php
include '../assets/admin/connect.php';

$semester=$_GET['semester'];
$department=$_GET['department'];

$sql_department = "SELECT department_name FROM department WHERE department_id='$department'";
$result_department = $conn->query($sql_department);
$row_department = $result_department->fetch_assoc();

$sql_semester = "SELECT semester_title FROM semester WHERE semester_id='$semester'";
$result_semester = $conn->query($sql_semester);
$row_semester = $result_semester->fetch_assoc();

$sql_courses = "SELECT course_id, subject_abbreviation, course_number, course_title
FROM course c JOIN subject s ON (c.subject_id=s.subject_id)
WHERE department_id='$department'";
$result_courses = $conn->query($sql_courses);

$sql_instructors = "SELECT instructor_id, first_name, last_name FROM instructor WHERE department_id='$department'";
$result_instructors = $conn->query($sql_instructors);

$sql_sections = "SELECT crn, subject_abbreviation, course_number, section_number, course_title, i.instructor_id, first_name, last_name, s.type_id, type_name, meeting_days, start_time, end_time, meeting_location, seat_capacity
FROM course c JOIN section s ON (c.course_id=s.course_id) JOIN subject u ON (c.subject_id=u.subject_id) JOIN instructor i ON (s.instructor_id=i.instructor_id) JOIN course_type t ON (s.type_id=t.type_id) JOIN semester e ON (s.semester_id=e.semester_id) JOIN department d ON (c.department_id=d.department_id) JOIN course_level l ON (c.level_id=l.level_id)
WHERE e.semester_id='$semester' AND d.department_id='$department'
ORDER BY subject_abbreviation ASC, course_number ASC, section_number ASC";
$result_sections = $conn->query($sql_sections);
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Section Management Dashboard</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#section-management').addClass('active');
  });
  </script>

  <style>
  th, td {
    vertical-align:middle!important;
  }
  .form-control {
    margin-bottom:10px;
  }
  </style>
</head>

<body>

  <?php include '../assets/admin/navbar.php'; ?>

  <div class='container'>

    <h1>Section Management Dashboard</h1>

    <p style='margin-bottom:35px;'>You may add, edit, or remove course sections by clicking the appropriate buttons.</p>

    <h2 style='margin-bottom:0; margin-top:35px;'><?php echo $row_department['department_name']; ?></h2>

    <button type='button' class='btn btn-success pull-right' data-toggle='modal' data-target='#addNewSection' style='position:relative; bottom:5px;'>Add <span class='mobile-hide'>New Section</span></button>

    <form action='../admin/section-management-dashboard.php?semester=<?php echo $semester; ?>&department=<?php echo $department; ?>' method='post'>
      <div class='modal fade' id='addNewSection' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Add New Section</h4>
            </div>
            <div class='modal-body'>
              <p style='margin-bottom:25px;'>Enter the details for the class section you are adding in the <strong><?php echo $row_department['department_name']; ?></strong> department during the <strong><?php echo $row_semester['semester_title']; ?></strong> semester below:</p>
              <div class='form-group'>
                <label>CRN</label>
                <input type='text' class='form-control' name='crn' minlength='5' maxlength='5' size='5' required>
              </div>
              <div class='form-group'>
                <label>Course</label>
                <select class='form-control' name='course' required>
                  <option selected disabled>Select Course</option>

                  <?php
                  while($row_courses = $result_courses->fetch_assoc()) {
                    echo "<option value='" . $row_courses['course_id'] . "'>" . $row_courses['subject_abbreviation'] . " " . $row_courses['course_number'] . " - " . $row_courses['course_title'] . "</option>";
                  }
                  ?>

                </select>
              </div>
              <div class='form-group'>
                <label>Section</label>
                <input type='text' class='form-control' name='section' minlength='3' maxlength='3' size='3' required>
              </div>
              <div class='form-group'>
                <label>Instructor</label>
                <select class='form-control' name='instructor' required>
                  <option selected disabled>Select Instructor</option>";

                  <?php
                  while($row_instructors = $result_instructors->fetch_assoc()) {
                    echo "<option value='" . $row_instructors['instructor_id'] . "'>" . $row_instructors['first_name'] . " " . $row_instructors['last_name'] . "</option>";
                  }
                  ?>

                </select>
              </div>

              <div class='form-group'>
                <label>Course Type</label>
                <select class='form-control' name='type' required>
                  <option selected disabled>Select Course Type</option>";

                  <?php
                  $sql_types = "SELECT type_id, type_name FROM course_type";
                  $result_types = $conn->query($sql_types);
                  while($row_types = $result_types->fetch_assoc()) {
                    echo "<option value='" . $row_types['type_id'] . "'>" . $row_types['type_name'] . "</option>";
                  }
                  ?>

                </select>
              </div>

              <div class='form-group'>
                <label>Meeting Days</label><br>
                <input type='checkbox' name='days[]' value='M'> Monday<br>
                <input type='checkbox' name='days[]' value='T'> Tuesday<br>
                <input type='checkbox' name='days[]' value='W'> Wednesday<br>
                <input type='checkbox' name='days[]' value='R'> Thursday<br>
                <input type='checkbox' name='days[]' value='F' style='margin-bottom:15px;'> Friday
              </div>
              <div class='form-group'>
                <label>Start Time</label>
                <input type='time' class='form-control' name='start'>
              </div>
              <div class='form-group'>
                <label>End Time</label>
                <input type='time' class='form-control' name='end'>
              </div>
              <div class='form-group'>
                <label>Location</label>
                <input type='text' class='form-control' name='location' required>
              </div>
              <div class='form-group'>
                <label>Seats</label>
                <input type='text' class='form-control' name='seats' minlength='1' maxlength='5' required>
              </div>
            </div>
            <div class='modal-footer'>
              <button type='submit' class='btn btn-success'>Add Section</button>
              <input type='hidden' name='addNewSection'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <?php
    if(isset($_POST['addNewSection'])) {
      $crn=$_POST['crn'];
      $course=$_POST['course'];
      $section=$_POST['section'];
      $instructor=$_POST['instructor'];
      $type=$_POST['type'];
      if (isset($_POST['days'])) {
        $days = implode('', $_POST['days']);
      }
      $start=$_POST['start'];
      $end=$_POST['end'];
      $location=$_POST['location'];
      $seats=$_POST['seats'];

      $sql_create = "INSERT INTO section (crn, course_id, section_number, instructor_id, semester_id, type_id, meeting_days, start_time, end_time, meeting_location, seat_capacity) VALUES ('$crn', '$course', '$section', '$instructor', '$semester', '$type', '$days', '$start', '$end', '$location', '$seats')";
      $conn->query($sql_create);
      echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>

    <h3 style='margin-top:5px; margin-bottom:25px; border-bottom:1px solid #aaa; padding-bottom:10px;'><?php echo $row_semester['semester_title']; ?></h3>

    <?php
    if ($result_sections->num_rows > 0) {
      echo "<table class='table table-striped'>
      <thead>
      <tr>
      <th>CRN</th>
      <th>Course</th>
      <th class='mobile-hide'>Section</th>
      <th class='mobile-hide' style='width:200px;'>Title</th>
      <th class='mobile-hide'>Instructor</th>
      <th class='mobile-hide'>Days</th>
      <th class='mobile-hide'>Times</th>
      <th class='mobile-hide'>Location</th>
      <th class='mobile-hide'>Seats</th>
      <th>Actions</th>
      </tr>
      </thead>
      <tbody>";

      while($row_sections = $result_sections->fetch_assoc()) {
        echo "<tr>
        <td>" . $row_sections['crn'] . "</td>
        <td>" . $row_sections['subject_abbreviation'] . " " . $row_sections['course_number'] . "</td>
        <td class='mobile-hide'>" . $row_sections['section_number'] . "</td>
        <td class='mobile-hide'>" . $row_sections['course_title'] . "</td>
        <td class='mobile-hide'>" . $row_sections['first_name'] . " " . $row_sections['last_name'] . "</td>";

        if ($row_sections['meeting_days'] === "")
        {
          echo "<td class='mobile-hide'>N/A</td>";
          echo "<td class='mobile-hide'>N/A</td>";
        } else {
          echo "<td class='mobile-hide'>" . $row_sections['meeting_days'] . "</td>
          <td class='mobile-hide'>" . date('g:i A', strtotime($row_sections['start_time'])) . " - " . date('g:i A', strtotime($row_sections['end_time'])) . "</td>";
        }

        echo "<td class='mobile-hide'>" . $row_sections['meeting_location'] . "</td>
        <td class='mobile-hide'>" . $row_sections['seat_capacity'] . "</td>
        <td>
        <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editSection" . $row_sections['crn'] . "'>Edit</button>
        <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeSection" . $row_sections['crn'] . "'>Remove</button>
        </td>
        </tr>";

        echo "<form action='' method='post'>
        <div class='modal fade' id='removeSection" . $row_sections['crn'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
        <div class='modal-content'>
        <div class='modal-header'>
        <h4 class='modal-title'>Remove Section</h4>
        </div>
        <div class='modal-body'>
        <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following section from the <strong>" . $row_department['department_name'] . "</strong> department during the <strong>" . $row_semester['semester_title'] . "</strong> semester?</p>
        <div class='modal-data'>
        <div class='row'>
        <div class='col-sm-4'><strong>CRN</strong></div>
        <div class='col-sm-8'>" . $row_sections['crn'] . "</div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Course Number</strong></div>
        <div class='col-sm-8'>" . $row_sections['subject_abbreviation'] . " " . $row_sections['course_number'] . "</div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Section</strong></div>
        <div class='col-sm-8'>" . $row_sections['section_number'] . "</div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Course Title</strong></div>
        <div class='col-sm-8'>" . $row_sections['course_title'] . "</div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Instructor</strong></div>
        <div class='col-sm-8'>" . $row_sections['first_name'] . " " . $row_sections['last_name'] . "</div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Course Type</strong></div>
        <div class='col-sm-8'>" . $row_sections['type_name'] . "</div>
        </div>";

        if ($row_sections['meeting_days'] === "")
        {
          echo "<div class='row'>
          <div class='col-sm-4'><strong>Meeting Days</strong></div>
          <div class='col-sm-8'>N/A</div>
          </div>
          <div class='row'>
          <div class='col-sm-4'><strong>Meeting Times</strong></div>
          <div class='col-sm-8'>N/A</div>
          </div>";
        } else {
          echo "<div class='row'>
          <div class='col-sm-4'><strong>Meeting Days</strong></div>
          <div class='col-sm-8'>" . $row_sections['meeting_days'] . "</div>
          </div>
          <div class='row'>
          <div class='col-sm-4'><strong>Meeting Times</strong></div>
          <div class='col-sm-8'>" . date('g:i A', strtotime($row_sections['start_time'])) . " - " . date('g:i A', strtotime($row_sections['end_time'])) . "</div>
          </div>";
        }

        echo "<div class='row'>
        <div class='col-sm-4'><strong>Meeting Location</strong></div>
        <div class='col-sm-8'>" . $row_sections['meeting_location'] . "</div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Seat Capacity</strong></div>
        <div class='col-sm-8'>" . $row_sections['seat_capacity'] . "</div>
        </div>
        </div>
        </div>
        <div class='modal-footer'>
        <input type='hidden' name='crn' value='" . $row_sections['crn'] . "'>
        <button type='submit' class='btn btn-danger'>Remove Section</button>
        <input type='hidden' name='removeSection" . $row_sections['crn'] . "'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
        </div>
        </div>
        </div>
        </div>
        </form>";

        if(isset($_POST["removeSection" . $row_sections['crn']])) {
          $crn=$_POST['crn'];
          $sql_delete = "DELETE FROM section WHERE crn='$crn'";
          $conn->query($sql_delete);
          echo "<meta http-equiv='refresh' content='0'>";
        }

        echo "<form action='' method='post'>
        <div class='modal fade' id='editSection" . $row_sections['crn'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
        <div class='modal-content'>
        <div class='modal-header'>
        <h4 class='modal-title'>Edit Section</h4>
        </div>
        <div class='modal-body'>
        <p style='margin-bottom:25px;'>Enter your edits for the following class section below:</p>
        <div class='modal-data'>
        <div class='row'>
        <div class='col-sm-4'><strong>CRN</strong></div>
        <div class='col-sm-8'>
        <input type='text' class='form-control' name='crn' value='" . $row_sections['crn'] . "' readonly>
        </div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Course Number</strong></div>
        <div class='col-sm-8'>
        <input type='text' class='form-control' name='course' value='" . $row_sections['course_number'] . "' disabled>
        </div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Section</strong></div>
        <div class='col-sm-8'>
        <input type='text' class='form-control' name='section' value='" . $row_sections['section_number'] . "' disabled>
        </div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Course Title</strong></div>
        <div class='col-sm-8'>
        <input type='text' class='form-control' name='title' value='" . $row_sections['course_title'] . "' disabled>
        </div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Instructor</strong></div>
        <div class='col-sm-8'>
        <select class='form-control' name='instructor' required>
        <option disabled>Select Instructor</option>";

        $sql_instructors_2 = "SELECT instructor_id, first_name, last_name FROM instructor WHERE department_id='$department'";
        $result_instructors_2 = $conn->query($sql_instructors_2);

        while($row_instructors_2 = $result_instructors_2->fetch_assoc()) {
          echo "<option value='" . $row_instructors_2['instructor_id'] . "'";
          if ($row_instructors_2['instructor_id']==$row_sections['instructor_id']) {
            echo " selected";
          }
          echo ">" . $row_instructors_2['first_name'] . " " . $row_instructors_2['last_name'] . "</option>";
        }

        echo "</select>
        </div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Course Type</strong></div>
        <div class='col-sm-8'>
        <select class='form-control' name='type' required>
        <option disabled>Select Course Type</option>";

        $sql_types = "SELECT type_id, type_name FROM course_type";
        $result_types = $conn->query($sql_types);

        while($row_types = $result_types->fetch_assoc()) {
          echo "<option value='" . $row_types['type_id'] . "'";
          if ($row_types['type_id']==$row_sections['type_id']) {
            echo " selected";
          }
          echo ">" . $row_types['type_name'] . "</option>";
        }

        echo "</select>
        </div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Meeting Days</strong></div>
        <div class='col-sm-8' style='margin-bottom:10px;'>";

        echo "<input type='checkbox' name='days[]' value='M'";
        if (strstr($row_sections['meeting_days'], "M")) {
          echo " checked";
        }
        echo "> Monday<br>

        <input type='checkbox' name='days[]' value='T'";
        if (strstr($row_sections['meeting_days'], "T")) {
          echo " checked";
        }
        echo "> Tuesday<br>

        <input type='checkbox' name='days[]' value='W'";
        if (strstr($row_sections['meeting_days'], "W")) {
          echo " checked";
        }
        echo "> Wednesday<br>

        <input type='checkbox' name='days[]' value='R'";
        if (strstr($row_sections['meeting_days'], "R")) {
          echo " checked";
        }
        echo "> Thursday<br>

        <input type='checkbox' name='days[]' value='F'";
        if (strstr($row_sections['meeting_days'], "F")) {
          echo " checked";
        }
        echo "> Friday";

        echo "</div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Start Time</strong></div>
        <div class='col-sm-8'>
        <input type='time' class='form-control' name='start' value='" . $row_sections['start_time'] . "'>
        </div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>End Time</strong></div>
        <div class='col-sm-8'>
        <input type='time' class='form-control' name='end' value='" . $row_sections['end_time'] . "'>
        </div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Meeting Location</strong></div>
        <div class='col-sm-8'>
        <input type='text' class='form-control' name='location' value='" . $row_sections['meeting_location'] . "' required>
        </div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Seat Capacity</strong></div>
        <div class='col-sm-8'>
        <input type='text' class='form-control' name='seats' value='" . $row_sections['seat_capacity'] . "' required>
        </div>
        </div>
        </div>
        </div>
        <div class='modal-footer'>
        <button type='submit' class='btn btn-primary'>Submit</button>
        <input type='hidden' name='editSection" . $row_sections['crn'] . "'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
        </div>
        </div>
        </div>
        </div>
        </form>";

        if(isset($_POST["editSection" . $row_sections['crn']])) {
          $crn=$_POST['crn'];
          $instructor=$_POST['instructor'];
          $type=$_POST['type'];
          if (isset($_POST['days'])) {
            $days = implode('', $_POST['days']);
          }
          $start=$_POST['start'];
          $end=$_POST['end'];
          $location=$_POST['location'];
          $seats=$_POST['seats'];
          $sql_update = "UPDATE section SET instructor_id='$instructor', type_id='$type',  meeting_days='$days', start_time='$start', end_time='$end', meeting_location='$location', seat_capacity='$seats' WHERE crn='$crn'";
          $conn->query($sql_update);
          echo "<meta http-equiv='refresh' content='0'>";
        }

      }

      echo "</tbody>
      </table>";

    } else {
      echo "<div class='alert alert-danger'><strong>Error: </strong>The department you have selected does not have any course sections being offered during the semester you have selected.</div>";
    }
    ?>

  </div>
</body>
</html>
