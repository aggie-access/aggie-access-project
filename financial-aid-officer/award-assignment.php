<?php
include '../assets/financial-aid-officer/connect.php';

$sql_semester = "SELECT semester_id, semester_title FROM semester ORDER BY start_date DESC";
$result_semester = $conn->query($sql_semester);
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Award Assignment</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#manage-awards').addClass('active');
  });
  </script>
</head>

<body>

  <?php include '../assets/financial-aid-officer/navbar.php'; ?>

  <div class='container'>

    <h1>Award Assignment</h1>
    <p style='margin-bottom:35px;'>Select a semester and enter a banner ID to assign a financial aid award to a particular student.</p>

    <form action='award-assignment-dashboard.php' method='get' style='margin-bottom:30px;' id='form'>

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
            <label>Banner ID</label>
            <input type='text' class='form-control' name='bannerID' minlength='9' maxlength='9' size='9' required>
          </div>
        </div>
      </div>

      <button type='submit' class='btn btn-default'>Submit</button>

    </form>

  </div>
</body>
</html>
