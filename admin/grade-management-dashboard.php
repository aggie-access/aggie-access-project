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
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Grade Management Dashboard</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#grade-management').addClass('active');
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

    <h1>Grade Management Dashboard</h1>

    <?php
    if ($result_section->num_rows > 0) {
      echo "<p style='margin-bottom:35px;'>You may edit the grades for each student in this class section by clicking the appropriate button.</p>";

      echo "<h2 style='margin-bottom:0; margin-top:35px;'>" . $row_section['subject_abbreviation'] . " " . $row_section['course_number'] . " | " . $row_section['section_number'] . "</h2>";

      echo "<h3 style='margin-top:5px; margin-bottom:25px; border-bottom:1px solid #aaa; padding-bottom:10px;'>" . $row_section['course_title'] . "</h3>";

      echo "<table class='table table-striped'>";
      echo "<thead>";
      echo "<tr>";
      echo "<th class='mobile-hide'>Banner ID</th>";
      echo "<th>Last Name</th>";
      echo "<th>First Name</th>";
      echo "<th>Final Grade</th>";
      echo "<th>Actions</th>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";

      while($row_roster = $result_roster->fetch_assoc()) {
        echo "<tr>";
        echo "<td class='mobile-hide'>" . $row_roster['banner_id'] . "</td>";
        echo "<td>" . $row_roster['last_name'] . "</td>";
        echo "<td>" . $row_roster['first_name'] . "</td>";

        $bannerID=$row_roster['banner_id'];

        $sql_grading_scale = "SELECT letter_grade FROM grading_scale ORDER BY letter_grade ASC";
        $result_grading_scale = $conn->query($sql_grading_scale);

        $sql_grade = "SELECT grade_id, letter_grade
        FROM student s JOIN registration r ON (s.banner_id=r.banner_id) JOIN grades g ON (r.registration_id=g.registration_id)
        WHERE crn='$crn' AND semester_id='$semester' AND s.banner_id='$bannerID'";
        $result_grade = $conn->query($sql_grade);
        $row_grade = $result_grade->fetch_assoc();

        if (empty($row_grade['letter_grade'])) {
          echo "<td>N/A</td>";
        } else {
          echo "<td>" . $row_grade['letter_grade'] . "</td>";
        }

        echo "<td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editGrade" . $row_roster['banner_id'] . "'>Manage</button></td>";
        echo "</tr>";

        echo "<form action='../admin/grade-management-dashboard.php?semester=" . $semester . "&crn=" . $crn . "' method='post'>
        <div class='modal fade' id='editGrade" . $row_roster['banner_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
        <div class='modal-content'>
        <div class='modal-header'>
        <h4 class='modal-title'>Manage Final Grade</h4>
        </div>
        <div class='modal-body'>
        <p style='margin-bottom:25px;'>Please select the final grade for the following student:</p>
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
        <div class='row'>
        <div class='col-sm-4'><strong>Final Grade</strong></div>
        <div class='col-sm-8'>
        <select class='form-control' name='grade' required>";

        if (empty($row_grade['letter_grade'])) {
          echo "<option selected disabled>Select Final Grade</option>";
          while($row_grading_scale = $result_grading_scale->fetch_assoc()) {
            echo "<option value='" . $row_grading_scale['letter_grade'] . "'>" . $row_grading_scale['letter_grade'] . "</option>";
          }
        } else {
          echo "<option disabled>Select Final Grade</option>";
          while($row_grading_scale = $result_grading_scale->fetch_assoc()) {
            echo "<option value='" . $row_grading_scale['letter_grade'] . "'";
            if ($row_grading_scale['letter_grade']==$row_grade['letter_grade']) {
              echo " selected";
            }
            echo ">" . $row_grading_scale['letter_grade'] . "</option>";
          }
          echo "<input type='hidden' name='grade-id' value='" . $row_grade['grade_id'] . "'>";
        }

        echo "</select>
        </div>
        </div>
        </div>
        </div>
        <div class='modal-footer'>
        <button type='submit' class='btn btn-primary'>Submit</button>
        <input type='hidden' name='editGrade" . $bannerID . "'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
        </div>
        </div>
        </div>
        </div>
        </form>";

        if(isset($_POST["editGrade" . $bannerID])) {
          $grade=$_POST['grade'];
          if (empty($row_grade['letter_grade'])) {
            $registrationID=$row_roster['registration_id'];
            $sql_create = "INSERT INTO grades (registration_id, letter_grade) VALUES ('$registrationID', '$grade')";
            $conn->query($sql_create);
            echo "<meta http-equiv='refresh' content='0'>";
          } else {
            $gradeID=$_POST['grade-id'];
            $sql_create = "UPDATE grades SET letter_grade='$grade' WHERE grade_id='$gradeID'";
            $conn->query($sql_create);
            echo "<meta http-equiv='refresh' content='0'>";
          }
        }
      }

      echo "</tbody>";
      echo "</table>";

    } else {
      echo "<p style='margin-bottom:35px;'>The course reference number you have entered is not valid. Please enter a valid course reference number and select the appropriate semester in order to manage the grades for the course section.</p>";
    }
    ?>

  </div>
</body>
</html>
