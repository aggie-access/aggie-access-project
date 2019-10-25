<?php
include '../assets/admin/connect.php';
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Transcript Management</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#transcript-management').addClass('active');
  });
  </script>
</head>

<body>

  <?php include '../assets/admin/navbar.php'; ?>

  <div class='container'>

    <h1>Transcript Management</h1>

    <p style='margin-bottom:35px;'>Enter the banner ID for a student to review their transcript.</p>

    <form action='transcript-management-dashboard.php' method='post' style='margin-bottom:30px;' id='form'>
      <div class='row'>
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
