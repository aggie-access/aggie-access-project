<?php
include '../assets/admin/connect.php';
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Grade Management Dashboard</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#grade-management').addClass('active');
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

    <h1>Grade Management Dashboard</h1>
    <p style='margin-bottom:35px;'>You may edit the grades for each student in this class section by clicking the appropriate button.</p>

    <h2 style='margin-bottom:0; margin-top:35px;'>CST 499 | 05A</h2>

    <h3 style='margin-top:5px; margin-bottom:25px; border-bottom:1px solid #aaa; padding-bottom:10px;'>Senior Project II: A Capstone Experience</h3>

    <table class='table table-striped'>
      <thead>
        <tr>
          <th class='mobile-hide'>Banner ID</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Final Grade</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class='mobile-hide'>123456789</td>
          <td>Smith</td>
          <td>John</td>
          <td>A</td>
          <td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editGrade123456789'>Manage</button></td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editGrade123456789' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Manage Final Grade</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Please select the final grade for the following student:</p>
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
                    <div class='row'>
                      <div class='col-sm-4'><strong>Final Grade</strong></div>
                      <div class='col-sm-8'>
                        <select class='form-control' name='grade' required>
                          <option disabled>Select Final Grade</option>
                          <option selected value='A'>A</option>
                          <option value='A-'>A-</option>
                          <option value='B+'>B+</option>
                          <option value='B'>B</option>
                          <option value='B-'>B-</option>
                          <option value='C+'>C+</option>
                          <option value='C'>C</option>
                          <option value='C-'>C-</option>
                          <option value='D+'>D+</option>
                          <option value='D'>D</option>
                          <option value='F'>F</option>
                          <option value='AU'>AU</option>
                          <option value='I'>I</option>
                          <option value='U'>U</option>
                          <option value='W'>W</option>
                        </select>
                      </div>
                    </div>
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

        <tr>
          <td class='mobile-hide'>987654321</td>
          <td>Thomas</td>
          <td>Mary</td>
          <td>C</td>
          <td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editGrade987654321'>Manage</button></td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editGrade987654321' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Manage Final Grade</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Please select the final grade for the following student:</p>
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
                    <div class='row'>
                      <div class='col-sm-4'><strong>Final Grade</strong></div>
                      <div class='col-sm-8'>
                        <select class='form-control' name='grade' required>
                          <option disabled>Select Final Grade</option>
                          <option value='A'>A</option>
                          <option value='A-'>A-</option>
                          <option value='B+'>B+</option>
                          <option value='B'>B</option>
                          <option value='B-'>B-</option>
                          <option value='C+'>C+</option>
                          <option selected value='C'>C</option>
                          <option value='C-'>C-</option>
                          <option value='D+'>D+</option>
                          <option value='D'>D</option>
                          <option value='F'>F</option>
                          <option value='AU'>AU</option>
                          <option value='I'>I</option>
                          <option value='U'>U</option>
                          <option value='W'>W</option>
                        </select>
                      </div>
                    </div>
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

        <tr>
          <td class='mobile-hide'>432101234</td>
          <td>Williams</td>
          <td>Taylor</td>
          <td>B</td>
          <td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editGrade432101234'>Manage</button></td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editGrade432101234' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Manage Final Grade</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Please select the final grade for the following student:</p>
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
                    <div class='row'>
                      <div class='col-sm-4'><strong>Final Grade</strong></div>
                      <div class='col-sm-8'>
                        <select class='form-control' name='grade' required>
                          <option disabled>Select Final Grade</option>
                          <option value='A'>A</option>
                          <option value='A-'>A-</option>
                          <option value='B+'>B+</option>
                          <option selected value='B'>B</option>
                          <option value='B-'>B-</option>
                          <option value='C+'>C+</option>
                          <option value='C'>C</option>
                          <option value='C-'>C-</option>
                          <option value='D+'>D+</option>
                          <option value='D'>D</option>
                          <option value='F'>F</option>
                          <option value='AU'>AU</option>
                          <option value='I'>I</option>
                          <option value='U'>U</option>
                          <option value='W'>W</option>
                        </select>
                      </div>
                    </div>
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

      </tbody>
    </table>

  </div>
</body>
</html>
