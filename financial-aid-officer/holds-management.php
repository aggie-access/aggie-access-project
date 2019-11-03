<?php
include '../assets/financial-aid-officer/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Holds Management</title>
  <?php include '../assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#holds-management").addClass("active");
  });
  </script>

  <script type="text/javascript">
  $(document).ready(function() {
    $("#form").submit(function(e) {
      e.preventDefault();
      $("#holdsInformation").show();
    });
  });
  </script>
</head>

<body>

  <?php include '../assets/financial-aid-officer/navbar.php'; ?>

  <div class="container">

    <h1>Holds Management</h1>
    <p style='margin-bottom:35px;'>Enter a student's banner ID to view information about the holds on their account.</p>

    <form action='' method='post' style='margin-bottom:30px;' id='form'>

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

    <div id='holdsInformation' style='display:none;'>

          <button class='btn btn-success pull-right' type='button' style='position:relative; top:20px;' data-toggle='modal' data-target='#placeHold'>Place Hold</span></button>

          <form action='' method='post'>
            <div class='modal fade' id='placeHold' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
              <div class='modal-dialog'>
                <div class='modal-content'>
                  <div class='modal-header'>
                    <h4 class='modal-title'>Place Hold on Student Account</h4>
                  </div>
                  <div class='modal-body'>
                    <p style='margin-bottom:25px;'>Are you sure that you would like to place a hold on this student's account?</p>
                    <div class='modal-data'>
                      <div class='row'>
                        <div class='col-sm-3'><strong>Full Name</strong></div>
                        <div class='col-sm-9'>Aggie T. Bulldog</div>
                      </div>
                    </div>
                  </div>
                  <div class='modal-footer'>
                    <button type='submit' class='btn btn-danger'>Place Hold</button>
                    <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

      <h3 style='margin-top:35px;'>Account Information</h3>
      <p style="margin-bottom:30px;">This is the selected student's account information.</p>

      <div class="row row-no-gutters profile-grid first-row">
        <div class="col-sm-3">
          <strong>Name</strong>
        </div>
        <div class="col-sm-9">Aggie T. Bulldog</div>
      </div>

      <div class="row row-no-gutters profile-grid last-row">
        <div class="col-sm-3">
          <strong>Holds</strong>
        </div>
        <div class="col-sm-9">The student does not have any holds placed on their record that will affect their financial aid award.</div>
      </div>
    </div>

  </div>
</body>
</html>
