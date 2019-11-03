<?php
include '../assets/financial-aid-officer/connect.php';
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Award Management</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#manage-awards').addClass('active');
  });
  </script>

  <style>
  th, td {
    vertical-align:middle!important;
  }
  </style>
</head>

<body>

  <?php include '../assets/financial-aid-officer/navbar.php'; ?>

  <div class='container'>

    <button class='btn btn-success pull-right' type='button' style='position:relative; top:20px;' data-toggle='modal' data-target='#newAward'>Add <span class='mobile-hide'>New Award</span></button>

    <form action='' method='post'>
      <div class='modal fade' id='newAward' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Add New Financial Aid Award</h4>
            </div>
            <div class='modal-body'>
              <p style='margin-bottom:25px;'>Fill in the form below to add a new financial aid award to the system:</p>
              <div class='form-group'>
                <label>Fund Title</label>
                <input type='text' class='form-control' name='fund' required>
              </div>
            </div>
            <div class='modal-footer'>
              <button type='submit' class='btn btn-success'>Add Award</button>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <h1>Award Management</h1>
    <p style='margin-bottom:35px;'>You can add, edit, and delete financial aid awards from the system using the appropriate buttons below.</p>

    <table class='table table-striped'>
      <thead>
        <tr>
          <th>Fund Title</th>
          <th style='width:175px;'>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Federal Pell Grant</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editAward1'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeAward1'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editAward1' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Edit New Financial Aid Award</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Enter your edits below for the selected financial aid award:</p>
                  <div class='form-group'>
                    <label>Fund Title</label>
                    <input type='text' class='form-control' name='fund' value='Federal Pell Grant' required>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-primary'>Submit</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <form action='' method='post'>
          <div class='modal fade' id='removeAward1' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Financial Aid Award</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following financial aid award from the system?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-3'><strong>Fund Title</strong></div>
                      <div class='col-sm-9'>Federal Pell Grant</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Award</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <tr>
          <td>Campus Based Tuition Fund</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editAward2'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeAward2'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editAward2' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Edit New Financial Aid Award</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Enter your edits below for the selected financial aid award:</p>
                  <div class='form-group'>
                    <label>Fund Title</label>
                    <input type='text' class='form-control' name='fund' value='Campus Based Tuition Fund' required>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-primary'>Submit</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <form action='' method='post'>
          <div class='modal fade' id='removeAward2' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Financial Aid Award</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following financial aid award from the system?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-3'><strong>Fund Title</strong></div>
                      <div class='col-sm-9'>Campus Based Tuition Fund</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Award</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <tr>
          <td>UNC Need Based Grant</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editAward3'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeAward3'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editAward3' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Edit New Financial Aid Award</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Enter your edits below for the selected financial aid award:</p>
                  <div class='form-group'>
                    <label>Fund Title</label>
                    <input type='text' class='form-control' name='fund' value='UNC Need Based Grant' required>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-primary'>Submit</button>
                  <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </form>

        <form action='' method='post'>
          <div class='modal fade' id='removeAward3' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove Financial Aid Award</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following financial aid award from the system?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-3'><strong>Fund Title</strong></div>
                      <div class='col-sm-9'>UNC Need Based Grant</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove Award</button>
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
