<?php
include '../assets/admin/connect.php';

$sql_department = "SELECT department_id, department_name FROM department ORDER BY department_name ASC";
$result_department = $conn->query($sql_department);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Class Management</title>
  <?php include '../assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#class-management").addClass("active");
  });
  </script>
</head>

<body>

  <?php include '../assets/admin/navbar.php'; ?>

  <div class="container">

    <h1>Class Management</h1>
    <p style='margin-bottom:35px;'>Select a department in the drop-down menu below to see all of the classes offered by a particular department.</p>

    <form action='class-management-dashboard.php' method='get' style='margin-bottom:30px;'>

      <div class='row'>
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
