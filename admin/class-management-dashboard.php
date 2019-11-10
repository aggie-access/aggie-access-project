<?php
include '../assets/admin/connect.php';

$department=$_GET['department'];

$sql_department = "SELECT department_name FROM department WHERE department_id='$department'";
$result_department = $conn->query($sql_department);
$row_department = $result_department->fetch_assoc();

$sql_subject = "SELECT * FROM subject ORDER BY subject_title ASC";
$result_subject = $conn->query($sql_subject);
$row_subject = $result_subject->fetch_assoc();

$sql_courses = "SELECT course_id, subject_abbreviation, course_number, course_title, course_description, credit_hours, c.level_id, level_name, prerequisite_id, corequisite_id, isbn
FROM course c JOIN subject s ON (c.subject_id=s.subject_id) JOIN course_level l ON (c.level_id=l.level_id)
WHERE department_id='$department'
ORDER BY subject_abbreviation ASC, course_number ASC";
$result_courses = $conn->query($sql_courses);

$sql_levels = "SELECT * FROM course_level";
$result_levels = $conn->query($sql_levels);

$sql_prerequisites = "SELECT course_id, subject_abbreviation, course_number, course_title
FROM course c JOIN subject s ON (c.subject_id=s.subject_id)
WHERE department_id='$department'
ORDER BY subject_abbreviation ASC, course_number ASC";
$result_prerequisites = $conn->query($sql_prerequisites);

$sql_corequisites = "SELECT course_id, subject_abbreviation, course_number, course_title
FROM course c JOIN subject s ON (c.subject_id=s.subject_id)
WHERE department_id='$department'
ORDER BY subject_abbreviation ASC, course_number ASC";
$result_corequisites = $conn->query($sql_corequisites);
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Class Management Dashboard</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#class-management').addClass('active');
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

    <h1>Class Management Dashboard</h1>
    <p style='margin-bottom:35px;'>You may add, edit, or remove courses from the selected department by clicking the appropriate buttons.</p>

    <button type='button' class='btn btn-success pull-right' data-toggle='modal' data-target='#addNewCourse' style='position:relative; bottom:5px;'>Add <span class='mobile-hide'>New Course</span></button>

    <form action='../admin/class-management-dashboard.php?department=<?php echo $department; ?>' method='post'>
      <div class='modal fade' id='addNewCourse' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Add New Course</h4>
            </div>
            <div class='modal-body'>
              <p style='margin-bottom:25px;'>Enter the details for the new class you are adding in the <strong><?php echo $row_department['department_name']; ?></strong> department below:</p>
              <div class='form-group'>
                <label>Subject</label>
                <select class='form-control' name='subject'>
                  <option selected disabled>Select Subject</option>

                  <?php
                  while($row_subject = $result_subject->fetch_assoc()) {
                    echo "<option value='" . $row_subject['subject_id'] . "'>" . $row_subject['subject_abbreviation'] . " - " . $row_subject['subject_title'] . "</option>";
                  }
                  ?>

                </select>
              </div>
              <div class='form-group'>
                <label>Course Number</label>
                <input type='text' class='form-control' name='number' minlength='3' maxlength='3' size='3' required>
              </div>
              <div class='form-group'>
                <label>Course Title</label>
                <input type='text' class='form-control' name='title' required>
              </div>
              <div class='form-group'>
                <label>Course Description</label>
                <textarea class='form-control' name='description' required></textarea>
              </div>
              <div class='form-group'>
                <label>Credit Hours</label>
                <select class='form-control' name='credits' required>
                  <option selected disabled>Select Credit Hours</option>
                  <option value='1.0'>1.0</option>
                  <option value='2.0'>2.0</option>
                  <option value='3.0'>3.0</option>
                  <option value='4.0'>4.0</option>
                </select>
              </div>
              <div class='form-group'>
                <label>Course Level</label>
                <select class='form-control' name='level' required>
                  <option selected disabled>Select Course Level</option>

                  <?php
                  while($row_levels = $result_levels->fetch_assoc()) {
                    echo "<option value='" . $row_levels['level_id'] . "'>" . $row_levels['level_name'] . "</option>";
                  }
                  ?>

                </select>
              </div>
              <div class='form-group'>
                <label>Prerequisite Course</label>
                <select class='form-control' name='prerequisite'>
                  <option selected disabled>Select Prerequisite Course</option>

                  <?php
                  while($row_prerequisites = $result_prerequisites->fetch_assoc()) {
                    echo "<option value='" . $row_prerequisites['course_id'] . "'>" . $row_prerequisites['subject_abbreviation'] . " " . $row_prerequisites['course_number'] . " - " . $row_prerequisites['course_title'] . "</option>";
                  }
                  ?>

                </select>
              </div>
              <div class='form-group'>
                <label>Corequisite Course</label>
                <select class='form-control' name='corequisite'>
                  <option selected disabled>Select Corequisite Course</option>

                  <?php
                  while($row_corequisites = $result_corequisites->fetch_assoc()) {
                    echo "<option value='" . $row_corequisites['course_id'] . "'>" . $row_corequisites['subject_abbreviation'] . " " . $row_corequisites['course_number'] . " - " . $row_corequisites['course_title'] . "</option>";
                  }
                  ?>

                </select>
              </div>
              <div class='form-group'>
                <label>Required Textbook ISBN</label>
                <input type='text' class='form-control' name='isbn' minlength='13' maxlength='13' size='13'>
              </div>
            </div>
            <div class='modal-footer'>
              <input type='hidden' name='department' value='<?php echo $department; ?>'>
              <button type='submit' class='btn btn-success'>Add Course</button>
              <input type='hidden' name='addNewCourse'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <?php
    if(isset($_POST['addNewCourse'])) {
      $department=$_POST['department'];
      $subject=$_POST['subject'];
      $number=$_POST['number'];
      $title=$_POST['title'];
      $description=$_POST['description'];
      $credits=$_POST['credits'];
      $level=$_POST['level'];
      $prerequisite=$_POST['prerequisite'];
      $corequisite=$_POST['corequisite'];
      $isbn=$_POST['isbn'];

      $sql_create = "INSERT INTO course (course_number, course_title, course_description, department_id, subject_id, credit_hours, level_id) VALUES ('$number', '$title', '$description', '$department', '$subject', '$credits', '$level')";
      $conn->query($sql_create);

      $id=$row_course_id['id'];

      if (isset($prerequisite)) {
        $sql_update_prerequisite = "UPDATE course SET prerequisite_id='$prerequisite' WHERE course_id='$id'";
        $conn->query($sql_update_prerequisite);
      }

      if (isset($corequisite)) {
        $sql_update_corequisite = "UPDATE course SET corequisite_id='$corequisite' WHERE course_id='$id'";
        $conn->query($sql_update_corequisite);
      }

      if (isset($isbn)) {
        $sql_update_isbn = "UPDATE course SET isbn='$isbn' WHERE course_id='$id'";
        $conn->query($sql_update_isbn);
      }

      echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>

    <h2 style='margin-bottom:25px; margin-top:35px; border-bottom:1px solid #aaa; padding-bottom:10px;'><?php echo $row_department['department_name']; ?></h2>

    <?php
    if ($result_courses->num_rows > 0) {
      echo "<table class='table table-striped'>
      <thead>
      <tr>
      <th>Course</th>
      <th class='mobile-hide' style='width:200px;'>Title</th>
      <th>Credits</th>
      <th class='mobile-hide'>Level</th>
      <th class='mobile-hide'>Prerequisites</th>
      <th class='mobile-hide'>Corequisites</th>
      <th>Actions</th>
      </tr>
      </thead>
      <tbody>";

      while($row_courses = $result_courses->fetch_assoc()) {
        echo "<tr>
        <td>" . $row_courses['subject_abbreviation'] . " " . $row_courses['course_number'] . "</td>
        <td class='mobile-hide'>" . $row_courses['course_title'] . "</td>
        <td>" . $row_courses['credit_hours'] . "</td>
        <td class='mobile-hide'>" . $row_courses['level_name'] . "</td>
        <td class='mobile-hide'>";

        if (isset($row_courses['prerequisite_id'])) {
          $prerequisite=$row_courses['prerequisite_id'];
          $sql_prerequisites = "SELECT subject_abbreviation, course_number
          FROM course c JOIN subject s ON (c.subject_id=s.subject_id)
          WHERE course_id='$prerequisite'";
          $result_prerequisites = $conn->query($sql_prerequisites);
          $row_prerequisites = $result_prerequisites->fetch_assoc();
          echo $row_prerequisites['subject_abbreviation'] . " " . $row_prerequisites['course_number'];
        } else {
          echo "N/A";
        }

        echo "</td>
        <td class='mobile-hide'>";

        if (isset($row_courses['corequisite_id'])) {
          $corequisite=$row_courses['corequisite_id'];
          $sql_corequisites = "SELECT subject_abbreviation, course_number
          FROM course c JOIN subject s ON (c.subject_id=s.subject_id)
          WHERE course_id='$corequisite'";
          $result_corequisites = $conn->query($sql_corequisites);
          $row_corequisites = $result_corequisites->fetch_assoc();
          echo $row_corequisites['subject_abbreviation'] . " " . $row_corequisites['course_number'];
        } else {
          echo "N/A";
        }

        echo "</td>
        <td>
        <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editCourse" . $row_courses['course_id'] . "'>Edit</button>
        <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeCourse" . $row_courses['course_id'] . "'>Remove</button>
        </td>
        </tr>";

        echo "<form action='' method='post'>
        <div class='modal fade' id='removeCourse" . $row_courses['course_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
        <div class='modal-content'>
        <div class='modal-header'>
        <h4 class='modal-title'>Remove Course</h4>
        </div>
        <div class='modal-body'>
        <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following course from the <strong>" . $row_department['department_name'] . "</strong> department?</p>
        <div class='modal-data'>
        <div class='row'>
        <div class='col-sm-4'><strong>Course Number</strong></div>
        <div class='col-sm-8'>" . $row_courses['subject_abbreviation'] . " " . $row_courses['course_number'] . "</div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Course Title</strong></div>
        <div class='col-sm-8'>" . $row_courses['course_title'] . "</div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Credits</strong></div>
        <div class='col-sm-8'>" . $row_courses['credit_hours'] . "</div>
        </div>
        <div class='row'>
        <div class='col-sm-4'><strong>Course Level</strong></div>
        <div class='col-sm-8'>" . $row_courses['level_name'] . "</div>
        </div>
        </div>
        </div>
        <div class='modal-footer'>
        <input type='hidden' name='course-id' value='" . $row_courses['course_id'] . "'>
        <button type='submit' class='btn btn-danger'>Remove Course</button>
        <input type='hidden' name='removeCourse" . $row_courses['course_id'] . "'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
        </div>
        </div>
        </div>
        </div>
        </form>";

        if(isset($_POST["removeCourse" . $row_courses['course_id']])) {
          $course=$_POST['course-id'];
          $sql_delete = "DELETE FROM course WHERE course_id='$course'";
          $conn->query($sql_delete);
          echo "<meta http-equiv='refresh' content='0'>";
        }

        $sql_subject = "SELECT * FROM subject ORDER BY subject_title ASC";
        $result_subject = $conn->query($sql_subject);
        $row_subject = $result_subject->fetch_assoc();

        $sql_levels = "SELECT * FROM course_level";
        $result_levels = $conn->query($sql_levels);

        $sql_prerequisites = "SELECT course_id, subject_abbreviation, course_number, course_title
        FROM course c JOIN subject s ON (c.subject_id=s.subject_id)
        WHERE department_id='$department'
        ORDER BY subject_abbreviation ASC, course_number ASC";
        $result_prerequisites = $conn->query($sql_prerequisites);

        $sql_corequisites = "SELECT course_id, subject_abbreviation, course_number, course_title
        FROM course c JOIN subject s ON (c.subject_id=s.subject_id)
        WHERE department_id='$department'
        ORDER BY subject_abbreviation ASC, course_number ASC";
        $result_corequisites = $conn->query($sql_corequisites);

        echo "<form action='' method='post'>
        <div class='modal fade' id='editCourse" . $row_courses['course_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
        <div class='modal-content'>
        <div class='modal-header'>
        <h4 class='modal-title'>Edit Course</h4>
        </div>
        <div class='modal-body'>
        <p style='margin-bottom:25px;'>Edit the details for the selected course in the <strong>" . $row_department['department_name'] . "</strong> department using the text boxes below:</p>
        <div class='form-group'>
        <label>Course Number</label>
        <input type='text' class='form-control' name='number' value='" . $row_courses['course_number'] . "' minlength='3' maxlength='3' size='3' required>
        </div>
        <div class='form-group'>
        <label>Course Title</label>
        <input type='text' class='form-control' name='title' value='" . $row_courses['course_title'] . "' required>
        </div>
        <div class='form-group'>
        <label>Course Description</label>
        <textarea class='form-control' name='description' required>" . $row_courses['course_description'] . "</textarea>
        </div>
        <div class='form-group'>
        <label>Credit Hours</label>
        <select class='form-control' name='credits' required>
        <option disabled>Select Credit Hours</option>
        <option value='1.0'>1.0</option>
        <option value='2.0'>2.0</option>
        <option value='3.0'>3.0</option>
        <option value='4.0'>4.0</option>
        </select>
        </div>
        <div class='form-group'>
        <label>Course Level</label>
        <select class='form-control' name='level' required>
        <option disabled>Select Course Level</option>";

        while($row_levels = $result_levels->fetch_assoc()) {
          echo "<option value='" . $row_levels['level_id'] . "'";
          if ($row_levels['level_id']==$row_courses['level_id']) {
            echo " selected";
          }
          echo ">" . $row_levels['level_name'] . "</option>";
        }

        echo "</select>
        </div>
        <div class='form-group'>
        <label>Prerequisite Course</label>
        <select class='form-control' name='prerequisite'>
        <option selected disabled>Select Prerequisite Course</option>";

        while($row_prerequisites = $result_prerequisites->fetch_assoc()) {
          echo "<option value='" . $row_prerequisites['course_id'] . "'";
          if ($row_prerequisites['course_id']==$row_courses['prerequisite_id']) {
            echo " selected";
          }
          echo ">" . $row_prerequisites['subject_abbreviation'] . " " . $row_prerequisites['course_number'] . " - " . $row_prerequisites['course_title'] . "</option>";
        }

        echo "</select>
        </div>
        <div class='form-group'>
        <label>Corequisite Course</label>
        <select class='form-control' name='corequisite'>
        <option selected disabled>Select Corequisite Course</option>";

        while($row_corequisites = $result_corequisites->fetch_assoc()) {
          echo "<option value='" . $row_corequisites['course_id'] . "'";
          if ($row_corequisites['course_id']==$row_courses['corequisite_id']) {
            echo " selected";
          }
          echo ">" . $row_corequisites['subject_abbreviation'] . " " . $row_corequisites['course_number'] . " - " . $row_corequisites['course_title'] . "</option>";
        }

        echo "</select>
        </div>
        <div class='form-group'>
        <label>Required Textbook ISBN</label>
        <input type='text' class='form-control' name='isbn' value='" . $row_courses['isbn'] . "' minlength='13' maxlength='13' size='13'>
        </div>
        </div>
        <div class='modal-footer'>
        <input type='hidden' name='course-id' value='" . $row_courses['course_id'] . "'>
        <button type='submit' class='btn btn-primary'>Submit</button>
        <input type='hidden' name='editCourse" . $row_courses['course_id'] . "'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
        </div>
        </div>
        </div>
        </div>
        </form>";

        if(isset($_POST["editCourse" . $row_courses['course_id']])) {
          $course=$_POST['course-id'];
          $number=$_POST['number'];
          $title=$_POST['title'];
          $description=$_POST['description'];
          $credits=$_POST['credits'];
          $level=$_POST['level'];
          $prerequisite=$_POST['prerequisite'];
          $corequisite=$_POST['corequisite'];
          $isbn=$_POST['isbn'];

          $sql_update = "UPDATE course SET course_number='$number', course_title='$title', course_description='$description', credit_hours='$credits', level_id='$level' WHERE course_id='$course'";
          $conn->query($sql_update);

          if (isset($prerequisite)) {
            $sql_update_prerequisite = "UPDATE course SET prerequisite_id='$prerequisite' WHERE course_id='$course'";
            $conn->query($sql_update_prerequisite);
          }

          if (isset($corequisite)) {
            $sql_update_corequisite = "UPDATE course SET corequisite_id='$corequisite' WHERE course_id='$course'";
            $conn->query($sql_update_corequisite);
          }

          if (isset($isbn)) {
            $sql_update_isbn = "UPDATE course SET isbn='$isbn' WHERE course_id='$course'";
            $conn->query($sql_update_isbn);
          }

          echo "<meta http-equiv='refresh' content='0'>";
        }
      }

      echo "</tbody>
      </table>";

    } else {
      echo "<div class='alert alert-danger'><strong>Error: </strong>The department you have selected does not have any courses in the system at this time.</div>";
    }
    ?>

  </div>
</body>
</html>
