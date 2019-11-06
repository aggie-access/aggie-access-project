<?php
include '../assets/admin/connect.php';

$sql_semester = "SELECT semester_id, semester_title FROM semester ORDER BY start_date DESC";
$result_semester = $conn->query($sql_semester);
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Grade Management</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#grade-management').addClass('active');
  });
  </script>
</head>

<body>

  <?php include '../assets/admin/navbar.php'; ?>

  <div class='container'>

    <h1>Grade Management</h1>
    <p style='margin-bottom:35px;'>Select a semester and enter a course reference number (CRN) to manage the grades for a particular class section.</p>

    <form action='grade-management-dashboard.php' method='get' style='margin-bottom:30px;' id='form'>

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
            <label>Course Reference Number (CRN)</label>
            <input type='text' class='form-control' name='crn' minlength='5' maxlength='5' size='5' required>
          </div>
        </div>
      </div>

      <button type='submit' class='btn btn-default'>Submit</button>

    </form>

  </div>
</body>
</html>
