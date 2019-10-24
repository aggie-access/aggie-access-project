<?php
include '../assets/admin/connect.php';
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>User Management</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#user-management').addClass('active');
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

    <div class='dropdown pull-right' style='position:relative; top:20px;'>
      <button class='btn btn-success dropdown-toggle' type='button' data-toggle='dropdown'>Add <span class='mobile-hide'>New User</span>
        <span class='caret'></span>
      </button>
      <ul class='dropdown-menu'>
        <li><a href='' data-toggle='modal' data-target='#addNewStudent'>Add New Student</a></li>
        <li><a href='' data-toggle='modal' data-target='#addNewAdmin'>Add New Administrator</a></li>
        <li><a href='' data-toggle='modal' data-target='#addNewFinAid'>Add New Financial Aid Officer</a></li>
        <li><a href='' data-toggle='modal' data-target='#addNewInstructor'>Add New Instructor</a></li>
      </ul>
    </div>

    <h1>User Management</h1>
    <p style='margin-bottom:35px;'>You can add, edit, and delete users from the system using the appropriate buttons below.</p>

    <form action='' method='post'>
      <div class='modal fade' id='addNewStudent' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Add New Student</h4>
            </div>
            <div class='modal-body'>
              <p style='margin-bottom:25px;'>Enter the account information for the student you would like to add to the system in the text boxes below:</p>
              <div class='form-group'>
                <label>Banner ID</label>
                <input type='text' class='form-control' name='bannerID' minlength='9' maxlength='9' size='9' required>
              </div>
              <div class='form-group'>
                <label>Password</label>
                <input type='text' class='form-control' name='password' required>
              </div>
              <div class='form-group'>
                <label>First Name</label>
                <input type='text' class='form-control' name='firstName' required>
              </div>
              <div class='form-group'>
                <label>Middle Initial</label>
                <input type='text' class='form-control' name='middleInitial' minlength='1' maxlength='1' size='1' required>
              </div>
              <div class='form-group'>
                <label>Last Name</label>
                <input type='text' class='form-control' name='lastName' required>
              </div>
              <div class='form-group'>
                <label>Birth Date</label>
                <input type='date' class='form-control' name='birthdate' required>
              </div>
              <div class='form-group'>
                <label>Email Address</label>
                <input type='email' class='form-control' name='email' required>
              </div>
              <div class='form-group'>
                <label>Student Level</label>
                <select class='form-control' name='level' required>
                  <option disabled selected>Select Student Level</option>
                  <option value='1'>Undergraduate</option>
                  <option value='2'>Graduate</option>
                </select>
              </div>
              <div class='form-group'>
                <label>College Affiliation</label>
                <select class='form-control' name='college' required>
                  <option disabled selected>Select College Affiliation</option>
                  <option value='1'>College of Science and Technology</option>
                  <option value='2'>College of Engineering</option>
                </select>
              </div>
              <div class='form-group'>
                <label>Degree Type</label>
                <select class='form-control' name='degree' required>
                  <option disabled selected>Select Degree Type</option>
                  <option value='1'>Bachelor of Arts</option>
                  <option value='2'>Bachelor of Science</option>
                </select>
              </div>
              <div class='form-group'>
                <label>Major</label>
                <select class='form-control' name='status' required>
                  <option disabled selected>Select Major</option>
                  <option value='1'>Computer Science</option>
                  <option value='2'>Information Technology</option>
                </select>
              </div>
              <div class='form-group'>
                <label>Expected Graduation Year</label>
                <input type='date' class='form-control' name='graduation' required>
              </div>
              <div class='form-group'>
                <label>Street Address</label>
                <input type='text' class='form-control' name='street' required>
              </div>
              <div class='form-group'>
                <label>City</label>
                <input type='text' class='form-control' name='city' required>
              </div>
              <div class='form-group'>
                <label>State</label>
                <input type='text' class='form-control' name='state' minlength='2' maxlength='2' size='2' required>
              </div>
              <div class='form-group'>
                <label>Zip Code</label>
                <input type='text' class='form-control' name='zip' required>
              </div>
              <div class='form-group'>
                <label>Phone Number</label>
                <input type='text' class='form-control' name='phone' required>
              </div>
              <div class='form-group'>
                <label>User Status</label>
                <select class='form-control' name='status' required>
                  <option disabled>Select User Status</option>
                  <option value='y' selected>Active</option>
                  <option value='n'>Inactive</option>
                </select>
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

    <form action='' method='post'>
      <div class='modal fade' id='addNewAdmin' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Add New Administrator</h4>
            </div>
            <div class='modal-body'>
              <p style='margin-bottom:25px;'>Enter the account information for the administrator you would like to add to the system in the text boxes below:</p>
              <div class='form-group'>
                <label>Banner ID</label>
                <input type='text' class='form-control' name='bannerID' minlength='9' maxlength='9' size='9' required>
              </div>
              <div class='form-group'>
                <label>Password</label>
                <input type='text' class='form-control' name='password' required>
              </div>
              <div class='form-group'>
                <label>First Name</label>
                <input type='text' class='form-control' name='firstName' required>
              </div>
              <div class='form-group'>
                <label>Middle Initial</label>
                <input type='text' class='form-control' name='middleInitial' minlength='1' maxlength='1' size='1' required>
              </div>
              <div class='form-group'>
                <label>Last Name</label>
                <input type='text' class='form-control' name='lastName' required>
              </div>
              <div class='form-group'>
                <label>User Status</label>
                <select class='form-control' name='status' required>
                  <option disabled>Select User Status</option>
                  <option value='y' selected>Active</option>
                  <option value='n'>Inactive</option>
                </select>
              </div>
            </div>
            <div class='modal-footer'>
              <button type='submit' class='btn btn-success'>Add Administrator</button>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <form action='' method='post'>
      <div class='modal fade' id='addNewFinAid' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Add New Financial Aid Officer</h4>
            </div>
            <div class='modal-body'>
              <p style='margin-bottom:25px;'>Enter the account information for the financial aid officer you would like to add to the system in the text boxes below:</p>
              <div class='form-group'>
                <label>Banner ID</label>
                <input type='text' class='form-control' name='bannerID' minlength='9' maxlength='9' size='9' required>
              </div>
              <div class='form-group'>
                <label>Password</label>
                <input type='text' class='form-control' name='password' required>
              </div>
              <div class='form-group'>
                <label>First Name</label>
                <input type='text' class='form-control' name='firstName' required>
              </div>
              <div class='form-group'>
                <label>Middle Initial</label>
                <input type='text' class='form-control' name='middleInitial' minlength='1' maxlength='1' size='1' required>
              </div>
              <div class='form-group'>
                <label>Last Name</label>
                <input type='text' class='form-control' name='lastName' required>
              </div>
              <div class='form-group'>
                <label>User Status</label>
                <select class='form-control' name='status' required>
                  <option disabled>Select User Status</option>
                  <option value='y' selected>Active</option>
                  <option value='n'>Inactive</option>
                </select>
              </div>
            </div>
            <div class='modal-footer'>
              <button type='submit' class='btn btn-success'>Add Financial Aid Officer</button>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <form action='' method='post'>
      <div class='modal fade' id='addNewInstructor' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Add New Instructor</h4>
            </div>
            <div class='modal-body'>
              <p style='margin-bottom:25px;'>Enter the account information for the instructor you would like to add to the system in the text boxes below:</p>
              <div class='form-group'>
                <label>Banner ID</label>
                <input type='text' class='form-control' name='bannerID' minlength='9' maxlength='9' size='9' required>
              </div>
              <div class='form-group'>
                <label>Password</label>
                <input type='text' class='form-control' name='password' required>
              </div>
              <div class='form-group'>
                <label>First Name</label>
                <input type='text' class='form-control' name='firstName' required>
              </div>
              <div class='form-group'>
                <label>Middle Initial</label>
                <input type='text' class='form-control' name='middleInitial' minlength='1' maxlength='1' size='1' required>
              </div>
              <div class='form-group'>
                <label>Last Name</label>
                <input type='text' class='form-control' name='lastName' required>
              </div>
              <div class='form-group'>
                <label>Email Address</label>
                <input type='email' class='form-control' name='email' required>
              </div>
              <div class='form-group'>
                <label>Department</label>
                <select class='form-control' name='department' required>
                  <option disabled selected value>Select Department</option>
                  <option value='11'>Accounting and Finance</option>
                  <option value='16'>Administration and Instructional Services</option>
                  <option value='1'>Agribusiness, Applied Economics and Agriscience Education</option>
                  <option value='2'>Animal Sciences</option>
                  <option value='31'>Applied Engineering Technology</option>
                  <option value='36'>Applied Science and Technology</option>
                  <option value='32'>Biology</option>
                  <option value='33'>Built Environment</option>
                  <option value='12'>Business Education</option>
                  <option value='21'>Chemical, Biological and Bio Engineering</option>
                  <option value='34'>Chemistry</option>
                  <option value='20'>Civil, Architectural and Environmental Engineering</option>
                  <option value='23'>Computational Science and Engineering</option>
                  <option value='22'>Computer Science</option>
                  <option value='35'>Computer Systems Technology</option>
                  <option value='17'>Counseling</option>
                  <option value='9'>Criminal Justice</option>
                  <option value='13'>Economics</option>
                  <option value='18'>Educator Preparation</option>
                  <option value='24'>Electrical and Computer Engineering</option>
                  <option value='5'>English</option>
                  <option value='3'>Family and Consumer Sciences</option>
                  <option value='37'>Graphic Design Technology</option>
                  <option value='6'>History and Political Science</option>
                  <option value='27'>Human Performance and Leisure Studies</option>
                  <option value='25'>Industrial and Systems Engineering</option>
                  <option value='7'>Journalism and Mass Communication</option>
                  <option value='19'>Leadership Studies and Adult Education</option>
                  <option value='8'>Liberal Studies</option>
                  <option value='14'>Management</option>
                  <option value='15'>Marketing and Supply Chain Management</option>
                  <option value='38'>Mathematics</option>
                  <option value='26'>Mechanical Engineering</option>
                  <option value='40'>Nanoengineering</option>
                  <option value='4'>Natural Resources and Environmental Design</option>
                  <option value='39'>Physics</option>
                  <option value='29'>Psychology</option>
                  <option value='28'>School of Nursing</option>
                  <option value='30'>Social Work and Sociology</option>
                  <option value='10'>Visual and Performing Arts</option>
                </select>
              </div>
              <div class='form-group'>
                <label>Office Location</label>
                <input type='text' class='form-control' name='office' required>
              </div>
              <div class='form-group'>
                <label>Office Phone Number</label>
                <input type='text' class='form-control' name='phone' minlength='9' maxlength='9' size='9' required>
              </div>
              <div class='form-group'>
                <label>User Status</label>
                <select class='form-control' name='status' required>
                  <option disabled>Select User Status</option>
                  <option value='y' selected>Active</option>
                  <option value='n'>Inactive</option>
                </select>
              </div>
            </div>
            <div class='modal-footer'>
              <button type='submit' class='btn btn-success'>Add Instructor</button>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <table class='table table-striped'>
      <thead>
        <tr>
          <th class='mobile-hide'>Banner ID</th>
          <th>Last Name</th>
          <th>First Name</th>
          <th class='mobile-hide'>Role</th>
          <th class='mobile-hide'>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class='mobile-hide'>123456789</td>
          <td>Smith</td>
          <td>John</td>
          <td class='mobile-hide'>Student</td>
          <td class='mobile-hide'>Active</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editUser123456789'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeUser123456789'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editUser123456789' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Edit User</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Enter your edits for the selected user in the text boxes below:</p>
                  <div class='form-group'>
                    <label>Banner ID</label>
                    <input type='text' class='form-control' name='bannerID' value='123456789' disabled>
                  </div>
                  <div class='form-group'>
                    <label>First Name</label>
                    <input type='text' class='form-control' name='firstName' value='John' required>
                  </div>
                  <div class='form-group'>
                    <label>Last Name</label>
                    <input type='text' class='form-control' name='lastName' value='Smith' required>
                  </div>
                  <div class='form-group'>
                    <label>User Role</label>
                    <select class='form-control' name='role' required>
                      <option disabled>Select User Role</option>
                      <option value='1' selected>Student</option>
                      <option value='2'>Administrator</option>
                      <option value='3'>Financial Aid Officer</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>User Status</label>
                    <select class='form-control' name='status' required>
                      <option disabled>Select User Status</option>
                      <option value='y' selected>Active</option>
                      <option value='n'>Inactive</option>
                    </select>
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
          <div class='modal fade' id='removeUser123456789' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove User</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following user from the system?</p>
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
                      <div class='col-sm-4'><strong>User Role</strong></div>
                      <div class='col-sm-8'>Student</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>User Status</strong></div>
                      <div class='col-sm-8'>Active</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove User</button>
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
          <td class='mobile-hide'>Administrator</td>
          <td class='mobile-hide'>Active</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editUser987654321'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeUser987654321'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editUser987654321' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Edit User</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Enter your edits for the selected user in the text boxes below:</p>
                  <div class='form-group'>
                    <label>Banner ID</label>
                    <input type='text' class='form-control' name='bannerID' value='987654321' disabled>
                  </div>
                  <div class='form-group'>
                    <label>First Name</label>
                    <input type='text' class='form-control' name='firstName' value='Mary' required>
                  </div>
                  <div class='form-group'>
                    <label>Last Name</label>
                    <input type='text' class='form-control' name='lastName' value='Thomas' required>
                  </div>
                  <div class='form-group'>
                    <label>User Role</label>
                    <select class='form-control' name='role' required>
                      <option disabled>Select User Role</option>
                      <option value='1'>Student</option>
                      <option value='2' selected>Administrator</option>
                      <option value='3'>Financial Aid Officer</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>User Status</label>
                    <select class='form-control' name='status' required>
                      <option disabled>Select User Status</option>
                      <option value='y' selected>Active</option>
                      <option value='n'>Inactive</option>
                    </select>
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
          <div class='modal fade' id='removeUser987654321' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove User</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following user from the system?</p>
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
                      <div class='col-sm-4'><strong>User Role</strong></div>
                      <div class='col-sm-8'>Administrator</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>User Status</strong></div>
                      <div class='col-sm-8'>Active</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove User</button>
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
          <td class='mobile-hide'>Financial Aid Officer</td>
          <td class='mobile-hide'>Inactive</td>
          <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editUser432101234'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeUser432101234'>Remove</button>
          </td>
        </tr>

        <form action='' method='post'>
          <div class='modal fade' id='editUser432101234' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Edit User</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Enter your edits for the selected user in the text boxes below:</p>
                  <div class='form-group'>
                    <label>Banner ID</label>
                    <input type='text' class='form-control' name='bannerID' value='432101234' disabled>
                  </div>
                  <div class='form-group'>
                    <label>First Name</label>
                    <input type='text' class='form-control' name='firstName' value='Taylor' required>
                  </div>
                  <div class='form-group'>
                    <label>Last Name</label>
                    <input type='text' class='form-control' name='lastName' value='Williams' required>
                  </div>
                  <div class='form-group'>
                    <label>User Role</label>
                    <select class='form-control' name='role' required>
                      <option disabled>Select User Role</option>
                      <option value='1'>Student</option>
                      <option value='2'>Administrator</option>
                      <option value='3' selected>Financial Aid Officer</option>
                    </select>
                  </div>
                  <div class='form-group'>
                    <label>User Status</label>
                    <select class='form-control' name='status' required>
                      <option disabled>Select User Status</option>
                      <option value='y'>Active</option>
                      <option value='n' selected>Inactive</option>
                    </select>
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
          <div class='modal fade' id='removeUser432101234' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h4 class='modal-title'>Remove User</h4>
                </div>
                <div class='modal-body'>
                  <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following user from the system?</p>
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
                      <div class='col-sm-4'><strong>User Role</strong></div>
                      <div class='col-sm-8'>Financial Aid Officer</div>
                    </div>
                    <div class='row'>
                      <div class='col-sm-4'><strong>User Status</strong></div>
                      <div class='col-sm-8'>Inactive</div>
                    </div>
                  </div>
                </div>
                <div class='modal-footer'>
                  <button type='submit' class='btn btn-danger'>Remove User</button>
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
