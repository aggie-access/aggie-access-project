<?php
include '../assets/financial-aid-officer/connect.php';
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Award Assignment Dashboard</title>
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
              <p style='margin-bottom:25px;'>Fill in the form below to add a new financial aid award to the student's account:</p>
              <div class='form-group'>
                <label>Fund</label>
                <select class='form-control' name='fund' required>
                  <option selected disabled>Select Fund</option>
                  <option value='1'>Federal Pell Grant</option>
                  <option value='2'>UNC Need Based Grant</option>
                  <option value='3'>Campus Based Tuition Fund</option>
                  <option value='4'>Direct Subsidized Loan</option>
                  <option value='5'>Direct Unsubsidized Loan</option>
                </select>
              </div>
              <div class='form-group'>
                <label>Fall Amount Given</label>
                <input type='number' class='form-control' name='fallAmountGiven' min='0.01' step='0.01' required>
              </div>
              <div class='form-group'>
                <label>Fall Amount Accepted</label>
                <input type='number' class='form-control' name='fallAmountAccepted' min='0.01' step='0.01'>
              </div>
              <div class='form-group'>
                <label>Spring Amount Given</label>
                <input type='number' class='form-control' name='springAmountGiven' min='0.01' step='0.01' required>
              </div>
              <div class='form-group'>
                <label>Spring Amount Accepted</label>
                <input type='number' class='form-control' name='springAmountAccepted' min='0.01' step='0.01'>
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

    <h1>Award Assignment Dashboard</h1>
    <p style='margin-bottom:35px;'>You can add, edit, and delete financial aid awards for the selected student using the appropriate buttons below.</p>

    <table class='table table-striped'>
      <thead>
        <tr>
          <th style='width:175px;'>Fund Title</th>
          <th class='mobile-hide'>Fall Amount Given</th>
          <th class='mobile-hide'>Fall Amount Accepted</th>
          <th class='mobile-hide'>Spring Amount Given</th>
          <th class='mobile-hide'>Spring Amount Accepted</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Federal Pell Grant</td>
          <td class='mobile-hide'>$500.00</td>
          <td class='mobile-hide'>$250.00</td>
          <td class='mobile-hide'>$500.00</td>
          <td class='mobile-hide'>$250.00</td>
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
                  <h4 class='modal-title'>Edit Financial Aid Award</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Enter your edits for the selected financial aid award in the text boxes below:</p>
                  <div class='form-group'>
                    <label>Fund</label>
                    <select class='form-control' name='fund' required>
                      <option disabled>Select Fund</option>
                      <option value='1' selected>Federal Pell Grant</option>
                      <option value='2'>UNC Need Based Grant</option>
                      <option value='3'>Campus Based Tuition Fund</option>
                      <option value='4'>Direct Subsidized Loan</option>
                      <option value='5'>Direct Unsubsidized Loan</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Fall Amount Given</label>
                    <input type='number' class='form-control' name='fallAmountGiven' min='0.01' step='0.01' value='500.00' required>
                  </div>
                  <div class='form-group'>
                    <label>Fall Amount Accepted</label>
                    <input type='number' class='form-control' name='fallAmountAccepted' min='0.01' step='0.01' value='250.00'>
                  </div>
                  <div class='form-group'>
                    <label>Spring Amount Given</label>
                    <input type='number' class='form-control' name='springAmountGiven' min='0.01' step='0.01' value='500.00' required>
                  </div>
                  <div class='form-group'>
                    <label>Spring Amount Accepted</label>
                    <input type='number' class='form-control' name='springAmountAccepted' min='0.01' step='0.01' value='250.00'>
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
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following financial aid award from the student's account?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-5'><strong>Fund Title</strong></div>
                      <div class='col-sm-7'>Federal Pell Grant</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-5'><strong>Fall Amount Given</strong></div>
                      <div class='col-sm-7'>$500.00</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-5'><strong>Fall Amount Accepted</strong></div>
                      <div class='col-sm-7'>$250.00</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-5'><strong>Spring Amount Given</strong></div>
                      <div class='col-sm-7'>$500.00</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-5'><strong>Spring Amount Accepted</strong></div>
                      <div class='col-sm-7'>$250.00</div>
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
          <td class='mobile-hide'>$1,000.00</td>
          <td class='mobile-hide'>$500.00</td>
          <td class='mobile-hide'>$1,000.00</td>
          <td class='mobile-hide'>$500.00</td>
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
                  <h4 class='modal-title'>Edit Financial Aid Award</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Enter your edits for the selected financial aid award in the text boxes below:</p>
                  <div class='form-group'>
                    <label>Fund</label>
                    <select class='form-control' name='fund' required>
                      <option disabled>Select Fund</option>
                      <option value='1'>Federal Pell Grant</option>
                      <option value='2'>UNC Need Based Grant</option>
                      <option value='3' selected>Campus Based Tuition Fund</option>
                      <option value='4'>Direct Subsidized Loan</option>
                      <option value='5'>Direct Unsubsidized Loan</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Fall Amount Given</label>
                    <input type='number' class='form-control' name='fallAmountGiven' min='0.01' step='0.01' value='1000.00' required>
                  </div>
                  <div class='form-group'>
                    <label>Fall Amount Accepted</label>
                    <input type='number' class='form-control' name='fallAmountAccepted' min='0.01' step='0.01' value='500.00'>
                  </div>
                  <div class='form-group'>
                    <label>Spring Amount Given</label>
                    <input type='number' class='form-control' name='springAmountGiven' min='0.01' step='0.01' value='1000.00' required>
                  </div>
                  <div class='form-group'>
                    <label>Spring Amount Accepted</label>
                    <input type='number' class='form-control' name='springAmountAccepted' min='0.01' step='0.01' value='500.00'>
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
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following financial aid award from the student's account?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-5'><strong>Fund Title</strong></div>
                      <div class='col-sm-7'>Campus Based Tuition Fund</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-5'><strong>Fall Amount Given</strong></div>
                      <div class='col-sm-7'>$1,000.00</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-5'><strong>Fall Amount Accepted</strong></div>
                      <div class='col-sm-7'>$500.00</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-5'><strong>Spring Amount Given</strong></div>
                      <div class='col-sm-7'>$1,000.00</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-5'><strong>Spring Amount Accepted</strong></div>
                      <div class='col-sm-7'>$500.00</div>
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
          <td>Direct Subsidized Loan</td>
          <td class='mobile-hide'>$750.00</td>
          <td class='mobile-hide'>$500.00</td>
          <td class='mobile-hide'>$750.00</td>
          <td class='mobile-hide'>$500.00</td>
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
                  <h4 class='modal-title'>Edit Financial Aid Award</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Enter your edits for the selected financial aid award in the text boxes below:</p>
                  <div class='form-group'>
                    <label>Fund</label>
                    <select class='form-control' name='fund' required>
                      <option disabled>Select Fund</option>
                      <option value='1'>Federal Pell Grant</option>
                      <option value='2'>UNC Need Based Grant</option>
                      <option value='3'>Campus Based Tuition Fund</option>
                      <option value='4' selected>Direct Subsidized Loan</option>
                      <option value='5'>Direct Unsubsidized Loan</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>Fall Amount Given</label>
                    <input type='number' class='form-control' name='fallAmountGiven' min='0.01' step='0.01' value='750.00' required>
                  </div>
                  <div class='form-group'>
                    <label>Fall Amount Accepted</label>
                    <input type='number' class='form-control' name='fallAmountAccepted' min='0.01' step='0.01' value='500.00'>
                  </div>
                  <div class='form-group'>
                    <label>Spring Amount Given</label>
                    <input type='number' class='form-control' name='springAmountGiven' min='0.01' step='0.01' value='750.00' required>
                  </div>
                  <div class='form-group'>
                    <label>Spring Amount Accepted</label>
                    <input type='number' class='form-control' name='springAmountAccepted' min='0.01' step='0.01' value='500.00'>
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
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following financial aid award from the student's account?</p>
                  <div class='modal-data'>
                    <div class='row'>
                      <div class='col-sm-5'><strong>Fund Title</strong></div>
                      <div class='col-sm-7'>Direct Subsidized Loan</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-5'><strong>Fall Amount Given</strong></div>
                      <div class='col-sm-7'>$750.00</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-5'><strong>Fall Amount Accepted</strong></div>
                      <div class='col-sm-7'>$500.00</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-5'><strong>Spring Amount Given</strong></div>
                      <div class='col-sm-7'>$750.00</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-5'><strong>Spring Amount Accepted</strong></div>
                      <div class='col-sm-7'>$500.00</div>
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
