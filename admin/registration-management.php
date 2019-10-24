<?php
include '../assets/admin/connect.php';
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Course Registration Management</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#registration-management').addClass('active');
  });
  </script>
</head>

<body>

  <?php include '../assets/admin/navbar.php'; ?>

  <div class='container'>

    <h1>Course Registration Management</h1>
    <p style='margin-bottom:35px;'>Select a semester and enter a course reference number (CRN) to see the roster for a particular class section.</p>

    <form action='registration-management-dashboard.php' method='post' style='margin-bottom:30px;' id='form'>

      <div class='row'>
        <div class='col-sm-6'>
          <div class='form-group'>
            <label>Semester</label>
            <select class='form-control' name='semester' required>
              <option disabled selected value>Select Semester</option>
              <option value='8'>Summer II 2020</option>
              <option value='7'>Summer I 2020</option>
              <option value='6'>Spring 2020</option>
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
