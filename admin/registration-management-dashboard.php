<?php
include '../assets/admin/connect.php';
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Registration Management</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#registration-management').addClass('active');
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
    <p style='margin-bottom:35px;'>You may add or remove students from this class section by clicking the appropriate buttons.</p>

    <h2 style='margin-bottom:0; margin-top:35px;'>CST 499 | 05A</h2>

    <button type='button' class='btn btn-success pull-right' data-toggle='modal' data-target='#addNewStudent' style='position:relative; bottom:5px;'>Add <span class='mobile-hide'>New Student</span></button>

    <form action='' method='post'>
      <div class='modal fade' id='addNewStudent' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Add New Student</h4>
            </div>
            <div class='modal-body'>
              <p style='margin-bottom:25px;'>Enter the banner ID of the student you would like to add to <strong>CST 499 05A</strong> in the text box below.</p>
              <div class='form-group'>
                <label>Banner ID</label>
                <input type='text' class='form-control' minlength='9' maxlength='9' size='9' required>
              </div>
            </div>
            <div class='modal-footer'>
              <button type='submit' class='btn btn-success'>Add Student</button>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <h3 style='margin-top:5px; margin-bottom:25px; border-bottom:1px solid #aaa; padding-bottom:10px;'>Senior Project II: A Capstone Experience</h3>

    <table class='table table-striped'>
      <thead>
        <tr>
          <th class='mobile-hide'>Banner ID</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class='mobile-hide'>123456789</td>
          <td>Smith</td>
          <td>John</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeStudent123456789'>Remove</button></td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeStudent123456789' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Student</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following student from <strong>CST 499 05A</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Banner ID</strong></div>
                      <div class='col-sm-8'>123456789</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>First Name</strong></div>
                      <div class='col-sm-8'>John</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Last Name</strong></div>
                      <div class='col-sm-8'>Smith</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Student</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <tr>
          <td class='mobile-hide'>987654321</td>
          <td>Thomas</td>
          <td>Mary</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeStudent987654321'>Remove</button></td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeStudent987654321' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Student</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following student from <strong>CST 499 05A</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Banner ID</strong></div>
                      <div class='col-sm-8'>987654321</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>First Name</strong></div>
                      <div class='col-sm-8'>Mary</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Last Name</strong></div>
                      <div class='col-sm-8'>Thomas</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Student</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <tr>
          <td class='mobile-hide'>432101234</td>
          <td>Williams</td>
          <td>Taylor</td>
          <td><button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeStudent432101234'>Remove</button></td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='removeStudent432101234' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Student</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following student from <strong>CST 499 05A</strong>?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Banner ID</strong></div>
                      <div class='col-sm-8'>432101234</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>First Name</strong></div>
                      <div class='col-sm-8'>Taylor</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>Last Name</strong></div>
                      <div class='col-sm-8'>Williams</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Student</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

      </tbody>
    </table>

  </div>
</body>
</html>
