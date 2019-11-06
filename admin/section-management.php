<?php
include '../assets/admin/connect.php';

$sql_semester = "SELECT semester_id, semester_title FROM semester ORDER BY start_date DESC";
$result_semester = $conn->query($sql_semester);

$sql_department = "SELECT department_id, department_name FROM department ORDER BY department_name ASC";
$result_department = $conn->query($sql_department);
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Section Management</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#section-management').addClass('active');
  });
  </script>
</head>

<body>

  <?php include '../assets/admin/navbar.php'; ?>

  <div class='container'>

    <h1>Section Management</h1>
    <p style='margin-bottom:35px;'>Select a semester and a department to see the class sections being offered during a particular semester.</p>

    <form action='section-management-dashboard.php' method='get' style='margin-bottom:30px;' id='form'>

      <div class='row'>
        <div class='col-sm-6'>
          <div class='form-group'>
            <label>Semester</label>
            <select class='form-control' name='semester' required>
              <option disabled selected value>Select Semester</option>
              <?php
              while($row_semester = $result_semester->fetch_assoc()) {
                echo "<option value='" . $row_semester['semester_id'] . "'>" . $row_semester['semester_title'] . "</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class='col-sm-6'>
          <div class='form-group'>
            <label>Department</label>
            <select class='form-control' name='department' required>
              <option disabled selected value>Select Department</option>
              <?php
              while($row_department = $result_department->fetch_assoc()) {
                echo "<option value='" . $row_department['department_id'] . "'>" . $row_department['department_name'] . "</option>";
              }
              ?>
            </select>
          </div>
        </div>
      </div>

      <button type='submit' class='btn btn-default'>Submit</button>

    </form>

  </div>
</body>
</html>
