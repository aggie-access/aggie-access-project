<?php
include '../assets/admin/connect.php';

$semester=$_GET['semester'];
$crn=$_GET['crn'];

$sql_section = "SELECT department_name, subject_abbreviation, course_number, section_number, course_title, semester_title
FROM section s JOIN course c ON (s.course_id=c.course_id) JOIN department d ON (c.department_id=d.department_id) JOIN subject u ON (c.subject_id=u.subject_id) JOIN semester e ON (s.semester_id=e.semester_id)
WHERE crn='$crn' AND s.semester_id='$semester'";
$result_section = $conn->query($sql_section);
$row_section = $result_section->fetch_assoc();

$sql_roster = "SELECT r.registration_id, r.banner_id, first_name, last_name
FROM student s JOIN registration r ON (s.banner_id=r.banner_id)
WHERE crn='$crn' AND semester_id='$semester'";
$result_roster = $conn->query($sql_roster);

$sql_registration = "SELECT DISTINCT r.banner_id
FROM student s JOIN registration r ON (s.banner_id=r.banner_id)
WHERE crn='$crn' AND semester_id='$semester'";
$result_registration = $conn->query($sql_registration);

if ($result_registration->num_rows > 0) {
  $registration = array();
  while($row_registration = $result_registration->fetch_assoc()) {
    $registration[] = $row_registration['banner_id'];
  }
}
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Course Registration Management Dashboard</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#registration-management').addClass('active');
  });
  </script>

  <script>
  $(document).ready(function(){
    $('.show-modal').click(function(){
      $('#addNewStudent').modal({
        backdrop: 'static',
        keyboard: false
      });
    });
  });
  </script>

  <style>
  th, td {
    vertical-align:middle!important;
  }
  </style>
</head>

<body>

  <?php include '../assets/admin/navbar.php'; ?>

  <div class='container'>

    <h1>Course Registration Management Dashboard</h1>

    <?php
    if ($result_section->num_rows > 0) {
      echo "<p style='margin-bottom:35px;'>You may add or remove students from this class section by clicking the appropriate buttons.</p>";

      echo "<h2 style='margin-bottom:0; margin-top:35px;'>" . $row_section['subject_abbreviation'] . " " . $row_section['course_number'] . " | " . $row_section['section_number'] . "</h2>";

      echo "<button type='button' class='btn btn-success pull-right' data-toggle='modal' data-target='#addNewStudent' style='position:relative; bottom:5px;'>Add <span class='mobile-hide'>New Student</span></button>";

      echo "<h3 style='margin-top:5px; margin-bottom:25px; border-bottom:1px solid #aaa; padding-bottom:10px;'>" . $row_section['course_title'] . "</h3>";

      echo "<form action='../admin/registration-management-dashboard.php?semester=" . $semester . "&crn=" . $crn . "' method='post'>
      <div class='modal fade' id='addNewStudent' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
      <div class='modal-dialog'>
      <div class='modal-content'>
      <div class='modal-header'>
      <h4 class='modal-title'>Add New Student</h4>
      </div>
      <div class='modal-body'>
      <p style='margin-bottom:25px;'>Enter the banner ID of the student you would like to add to <strong>" . $row_section['subject_abbreviation'] . " " . $row_section['course_number'] . " " . $row_section['section_number'] . "</strong> in the text box below.</p>
      <div class='form-group'>
      <label>Banner ID</label>
      <input type='text' class='form-control' name='banner-id' minlength='9' maxlength='9' size='9' required>
      </div>
      </div>
      <div class='modal-footer'>
      <button type='submit' class='btn btn-success'>Add Student</button>
      <input type='hidden' name='addNewStudent'>
      <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
      </div>
      </div>
      </div>
      </div>
      </form>";

      if(isset($_POST['addNewStudent'])) {
        $newBannerID=$_POST['banner-id'];
        $sql_user = "SELECT s.banner_id, user_type_title
        FROM student s JOIN users u ON (s.banner_id=u.banner_id) JOIN user_type t ON (u.user_type_id=t.user_type_id)
        WHERE s.banner_id='$newBannerID'";
        $result_user = $conn->query($sql_user);
        $row_user = $result_user->fetch_assoc();

        if ($result_user->num_rows > 0) {
          if($row_user['user_type_title']==='Student' AND !in_array($newBannerID, $registration)) {
            $sql_create = "INSERT INTO registration (banner_id, semester_id, crn) VALUES ('$newBannerID', '$semester', '$crn')";
            $conn->query($sql_create);
            echo "<meta http-equiv='refresh' content='0'>";
          } else {
            echo "<div class='alert alert-danger'>
            <strong>Error: </strong>The banner ID you have entered is invalid. Please enter a valid banner ID in order to register a student in the selected course section.
            </div>";
          }
        } else {
          echo "<div class='alert alert-danger'>
          <strong>Error: </strong>The banner ID you have entered is invalid. Please enter a valid banner ID in order to register a student in the selected course section.
          </div>";
        }
      }

      echo "<table class='table table-striped'>
      <thead>
      <tr>
      <th class='mobile-hide'>Banner ID</th>
      <th>Last Name</th>
      <th>First Name</th>
      <th>Actions</th>
      </tr>
      </thead>
      <tbody>";

      while($row_roster = $result_roster->fetch_assoc()) {
        $bannerID=$row_roster['banner_id'];
        echo "<tr>
        <td class='mobile-hide'>" . $row_roster['banner_id'] . "</td>
        <td>" . $row_roster['last_name'] . "</td>
        <td>" . $row_roster['first_name'] . "</td>
        <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeStudent" . $row_roster['banner_id'] . "'>Remove</button></td>
        </tr>";

        $sql_grade = "SELECT letter_grade
        FROM student s JOIN registration r ON (s.banner_id=r.banner_id) JOIN grades g ON (r.registration_id=g.registration_id)
        WHERE crn='$crn' AND semester_id='$semester' AND s.banner_id='$bannerID'";
        $result_grade = $conn->query($sql_grade);
        $row_grade = $result_grade->fetch_assoc();

        if ($result_grade->num_rows > 0) {
          echo "<div class='modal fade' id='removeStudent" . $row_roster['banner_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
          <div class='modal-dialog'>
          <div class='modal-content'>
          <div class='modal-header'>
          <h4 class='modal-title'>Remove Student</h4>
          </div>
          <div class='modal-body'>
          <div class='alert alert-danger'><strong>Error: </strong>" . $row_roster['first_name'] . " " . $row_roster['last_name'] . " cannot be removed from this class section because their final grade has already been assigned.</div>
          </div>
          <div class='modal-footer'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
          </div>
          </div>
          </div>
          </div>";

        } else {
          echo "<form action='../admin/registration-management-dashboard.php?semester=" . $semester . "&crn=" . $crn . "' method='post'>
          <div class='modal fade' id='removeStudent" . $row_roster['banner_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
          <div class='modal-dialog'>
          <div class='modal-content'>
          <div class='modal-header'>
          <h4 class='modal-title'>Remove Student</h4>
          </div>
          <div class='modal-body'>
          <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following student from <strong>" . $row_section['subject_abbreviation'] . " " . $row_section['course_number'] . " " . $row_section['section_number'] . "</strong>?</p>
          <div class='modal-data'>
          <div class='row'>
          <div class='col-sm-4'><strong>Banner ID</strong></div>
          <div class='col-sm-8'>" . $row_roster['banner_id'] . "</div>
          </div>
          <div class='row'>
          <div class='col-sm-4'><strong>First Name</strong></div>
          <div class='col-sm-8'>" . $row_roster['first_name'] . "</div>
          </div>
          <div class='row'>
          <div class='col-sm-4'><strong>Last Name</strong></div>
          <div class='col-sm-8'>" . $row_roster['last_name'] . "</div>
          </div>
          </div>
          </div>
          <div class='modal-footer'>
          <input type='hidden' name='registration-id' value='" . $row_roster['registration_id'] . "'>
          <button type='submit' class='btn btn-danger'>Remove Student</button>
          <input type='hidden' name='removeStudent" . $bannerID . "'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
          </div>
          </div>
          </div>
          </div>
          </form>";
        }

        if(isset($_POST["removeStudent" . $bannerID])) {
          $registrationID=$_POST['registration-id'];
          $sql_delete = "DELETE FROM registration WHERE registration_id='$registrationID'";
          $conn->query($sql_delete);
          echo "<meta http-equiv='refresh' content='0'>";
        }
      }

      echo "</tbody>
      </table>";

    } else {
      echo "<p style='margin-bottom:35px;'>The course reference number you have entered is not valid. Please enter a valid course reference number and select the appropriate semester in order to manage the roster for the course section.</p>";
    }
    ?>

  </div>
</body>
</html>
