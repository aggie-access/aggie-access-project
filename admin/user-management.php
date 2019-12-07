<?php
include '../assets/admin/connect.php';

$sql_students = "SELECT u.banner_id, first_name, last_name, u.user_type_id, user_type_title, status
FROM users u JOIN user_type t ON (u.user_type_id=t.user_type_id) JOIN student s ON (s.banner_id=u.banner_id)
ORDER BY last_name ASC, first_name ASC";
$result_students = $conn->query($sql_students);

$sql_staff = "SELECT u.banner_id, first_name, last_name, u.user_type_id, user_type_title, status
FROM users u JOIN user_type t ON (u.user_type_id=t.user_type_id) JOIN staff s ON (s.banner_id=u.banner_id)
ORDER BY user_type_title ASC, last_name ASC, first_name ASC";
$result_staff = $conn->query($sql_staff);

$sql_departments = "SELECT department_id, department_name FROM department ORDER BY department_name ASC";
$result_departments = $conn->query($sql_departments);

$sql_levels = "SELECT * FROM course_level";
$result_levels = $conn->query($sql_levels);

$sql_classifications = "SELECT classification_id, classification_title FROM classification";
$result_classifications = $conn->query($sql_classifications);

$sql_colleges = "SELECT * FROM college ORDER BY college_name ASC";
$result_colleges = $conn->query($sql_colleges);

$sql_degrees = "SELECT degree_id, degree_title FROM degree ORDER BY degree_title ASC";
$result_degrees = $conn->query($sql_degrees);

$sql_majors = "SELECT d.degree_id, degree_title, major_id, major_title
FROM major m JOIN degree d ON (m.degree_id=d.degree_id)
ORDER BY major_title ASC, degree_title ASC";
$result_majors = $conn->query($sql_majors);
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
                <input type='date' class='form-control' name='birthDate' required>
              </div>
              <div class='form-group'>
                <label>Email Address</label>
                <input type='email' class='form-control' name='email' required>
              </div>
              <div class='form-group'>
                <label>Student Level</label>
                <select class='form-control' name='level' required>
                  <option disabled selected>Select Student Level</option>

                  <?php
                  while($row_levels = $result_levels->fetch_assoc()) {
                    echo "<option value='" . $row_levels['level_id'] . "'>" . $row_levels['level_name'] . "</option>";
                  }
                  ?>

                </select>
              </div>
              <div class='form-group'>
                <label>Classification</label>
                <select class='form-control' name='classification' required>
                  <option disabled selected>Select Student Classification</option>

                  <?php
                  while($row_classifications = $result_classifications->fetch_assoc()) {
                    echo "<option value='" . $row_classifications['classification_id'] . "'>" . $row_classifications['classification_title'] . "</option>";
                  }
                  ?>

                </select>
              </div>
              <div class='form-group'>
                <label>College Affiliation</label>
                <select class='form-control' name='college' required>
                  <option disabled selected>Select College Affiliation</option>

                  <?php
                  while($row_colleges = $result_colleges->fetch_assoc()) {
                    echo "<option value='" . $row_colleges['college_id'] . "'>" . $row_colleges['college_name'] . "</option>";
                  }
                  ?>

                </select>
              </div>
              <div class='form-group'>
                <label>Degree Type</label>
                <select class='form-control' name='degree' required>
                  <option disabled selected>Select Degree Type</option>

                  <?php
                  while($row_degrees = $result_degrees->fetch_assoc()) {
                    echo "<option value='" . $row_degrees['degree_id'] . "'>" . $row_degrees['degree_title'] . "</option>";
                  }
                  ?>

                </select>
              </div>
              <div class='form-group'>
                <label>Major</label>
                <select class='form-control' name='major' required>
                  <option disabled selected>Select Major</option>

                  <?php
                  while($row_majors = $result_majors->fetch_assoc()) {
                    echo "<option value='" . $row_majors['major_id'] . "'>" . $row_majors['major_title'] . " - " . $row_majors['degree_title'] . "</option>";
                  }
                  ?>

                </select>
              </div>
              <div class='form-group'>
                <label>Expected Graduation Year</label>
                <input type='text' class='form-control' name='graduation' minlength='4' maxlength='4' size='4' required>
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
                <input type='text' class='form-control' name='zip' minlength='5' maxlength='5' size='5' required>
              </div>
              <div class='form-group'>
                <label>Phone Number</label>
                <input type='text' class='form-control' name='phone' minlength='10' maxlength='10' size='10' required>
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
              <input type='hidden' name='addNewStudent'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <?php
    if(isset($_POST["addNewStudent"])) {
      $bannerID=$_POST['bannerID'];
      $password=$_POST['password'];
      $status=$_POST['status'];
      $firstName=$_POST['firstName'];
      $middleInitial=$_POST['middleInitial'];
      $lastName=$_POST['lastName'];
      $birthDate=$_POST['birthDate'];
      $email=$_POST['email'];
      $level=$_POST['level'];
      $classification=$_POST['classification'];
      $college=$_POST['college'];
      $degree=$_POST['degree'];
      $major=$_POST['major'];
      $graduation=$_POST['graduation'];
      $street=$_POST['street'];
      $city=$_POST['city'];
      $state=$_POST['state'];
      $zip=$_POST['zip'];
      $phone=$_POST['phone'];

      $sql_create_student_users = "INSERT INTO users (banner_id, password, user_type_id, status) VALUES ('$bannerID', '$password', '1', '$status')";

      $sql_create_student = "INSERT INTO student (banner_id, first_name, middle_initial, last_name, birth_date, student_email, level_id, classification_id, college_id, degree_id, major_id, graduation_year, holds, street, city, state, zip, phone_number) VALUES ('$bannerID', '$firstName', '$middleInitial', '$lastName', '$birthDate', '$email', '$level', '$classification', '$college', '$degree', '$major', '$graduation', '0', '$street', '$city', '$state', '$zip', '$phone')";

      $conn->query($sql_create_student_users);
      $conn->query($sql_create_student);
      echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>

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
              <input type='hidden' name='addNewAdmin'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <?php
    if(isset($_POST["addNewAdmin"])) {
      $bannerID=$_POST['bannerID'];
      $password=$_POST['password'];
      $status=$_POST['status'];
      $firstName=$_POST['firstName'];
      $middleInitial=$_POST['middleInitial'];
      $lastName=$_POST['lastName'];
      $sql_create_admin_users = "INSERT INTO users (banner_id, password, user_type_id, status) VALUES ('$bannerID', '$password', '2', '$status')";
      $sql_create_admin_staff = "INSERT INTO staff (banner_id, first_name, middle_initial, last_name) VALUES ('$bannerID', '$firstName', '$middleInitial', '$lastName')";
      $conn->query($sql_create_admin_users);
      $conn->query($sql_create_admin_staff);
      echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>

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
              <input type='hidden' name='addNewFinAid'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <?php
    if(isset($_POST["addNewFinAid"])) {
      $bannerID=$_POST['bannerID'];
      $password=$_POST['password'];
      $status=$_POST['status'];
      $firstName=$_POST['firstName'];
      $middleInitial=$_POST['middleInitial'];
      $lastName=$_POST['lastName'];
      $sql_create_finAid_users = "INSERT INTO users (banner_id, password, user_type_id, status) VALUES ('$bannerID', '$password', '3', '$status')";
      $sql_create_finAid_staff = "INSERT INTO staff (banner_id, first_name, middle_initial, last_name) VALUES ('$bannerID', '$firstName', '$middleInitial', '$lastName')";
      $conn->query($sql_create_finAid_users);
      $conn->query($sql_create_finAid_staff);
      echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>

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

                  <?php
                  while($row_departments = $result_departments->fetch_assoc()) {
                    echo "<option value='" . $row_departments['department_id'] . "'>" . $row_departments['department_name'] . "</option>";
                  }
                  ?>

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
              <input type='hidden' name='addNewInstructor'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <?php
    if(isset($_POST["addNewInstructor"])) {
      $bannerID=$_POST['bannerID'];
      $password=$_POST['password'];
      $status=$_POST['status'];
      $firstName=$_POST['firstName'];
      $middleInitial=$_POST['middleInitial'];
      $lastName=$_POST['lastName'];
      $email=$_POST['email'];
      $department=$_POST['department'];
      $office=$_POST['office'];
      $phone=$_POST['phone'];

      $sql_create_instructor_users = "INSERT INTO users (banner_id, password, user_type_id, status) VALUES ('$bannerID', '$password', '2', '$status')";

      $sql_create_instructor_staff = "INSERT INTO staff (banner_id, first_name, middle_initial, last_name) VALUES ('$bannerID', '$firstName', '$middleInitial', '$lastName')";

      $sql_create_instructor = "INSERT INTO instructor (first_name, middle_initial, last_name, email, office_location, office_phone, department_id) VALUES ('$firstName', '$middleInitial', '$lastName', '$email', '$office', '$phone', '$department')";

      $conn->query($sql_create_instructor_users);
      $conn->query($sql_create_instructor_staff);
      $conn->query($sql_create_instructor);
      echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>

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

        <?php
        while($row_students = $result_students->fetch_assoc()) {
          echo "<tr>
          <td class='mobile-hide'>" . $row_students['banner_id'] . "</td>
          <td>" . $row_students['last_name'] . "</td>
          <td>" . $row_students['first_name'] . "</td>
          <td class='mobile-hide'>" . $row_students['user_type_title'] . "</td>
          <td class='mobile-hide'>";

          if ($row_students['status']==='y') {
            echo "Active";
          } else {
            echo "Inactive";
          }

          echo "</td>
          <td>
          <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editUser" . $row_students['banner_id'] . "'>Edit</button>
          <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeUser" . $row_students['banner_id'] . "'>Remove</button>
          </td>
          </tr>";

          echo "<form action='' method='post'>
          <div class='modal fade' id='removeUser" . $row_students['banner_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
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
          <div class='col-sm-8'>" . $row_students['banner_id'] . "</div>
          </div>
          <div class='row'>
          <div class='col-sm-4'><strong>First Name</strong></div>
          <div class='col-sm-8'>" . $row_students['first_name'] . "</div>
          </div>
          <div class='row'>
          <div class='col-sm-4'><strong>Last Name</strong></div>
          <div class='col-sm-8'>" . $row_students['last_name'] . "</div>
          </div>
          <div class='row'>
          <div class='col-sm-4'><strong>User Role</strong></div>
          <div class='col-sm-8'>" . $row_students['user_type_title'] . "</div>
          </div>
          <div class='row'>
          <div class='col-sm-4'><strong>User Status</strong></div>
          <div class='col-sm-8'>";

          if ($row_students['status']==='y') {
            echo "Active";
          } else {
            echo "Inactive";
          }

          echo "</div>
          </div>
          </div>
          </div>
          <div class='modal-footer'>
          <input type='hidden' name='banner-id' value='" . $row_students['banner_id'] . "'>
          <button type='submit' class='btn btn-danger'>Remove User</button>
          <input type='hidden' name='removeUser" . $row_students['banner_id'] . "'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
          </div>
          </div>
          </div>
          </div>
          </form>";

          if(isset($_POST["removeUser" . $row_students['banner_id']])) {
            $bannerID=$_POST['banner-id'];
            $sql_delete_students = "DELETE FROM users WHERE banner_id='$bannerID'";
            $conn->query($sql_delete_students);
            echo "<meta http-equiv='refresh' content='0'>";
          }

          echo "<form action='' method='post'>
          <div class='modal fade' id='editUser" . $row_students['banner_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
          <div class='modal-dialog'>
          <div class='modal-content'>
          <div class='modal-header'>
          <h4 class='modal-title'>Edit User</h4>
          </div>
          <div class='modal-body'>
          <p style='margin-bottom:25px;'>Enter your edits for the selected user in the text boxes below:</p>
          <div class='form-group'>
          <label>Banner ID</label>
          <input type='text' class='form-control' name='bannerID' value='" . $row_students['banner_id'] . "' readonly>
          </div>
          <div class='form-group'>
          <label>First Name</label>
          <input type='text' class='form-control' name='firstName' value='" . $row_students['first_name'] . "' required>
          </div>
          <div class='form-group'>
          <label>Last Name</label>
          <input type='text' class='form-control' name='lastName' value='" . $row_students['last_name'] . "' required>
          </div>
          <div class='form-group'>
          <label>User Role</label>
          <select class='form-control' name='role' required>
          <option disabled>Select User Role</option>";

          $sql_roles = "SELECT * FROM user_type";
          $result_roles = $conn->query($sql_roles);

          while($row_roles = $result_roles->fetch_assoc()) {
            echo "<option value='" . $row_roles['user_type_id'] . "'";
            if ($row_roles['user_type_id']==$row_students['user_type_id']) {
              echo " selected";
            }
            echo ">" . $row_roles['user_type_title'] . "</option>";
          }

          echo "</select>
          </div>
          <div class='form-group'>
          <label>User Status</label>
          <select class='form-control' name='status' required>
          <option disabled>Select User Status</option>
          <option value='y'";
          if ($row_students['status']==='y') {
            echo " selected";
          }
          echo ">Active</option>
          <option value='n'";
          if ($row_students['status']==='n') {
            echo " selected";
          }
          echo ">Inactive</option>
          </select>
          </div>
          </div>
          <div class='modal-footer'>
          <button type='submit' class='btn btn-primary'>Submit</button>
          <input type='hidden' name='editUser" . $row_students['banner_id'] . "'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
          </div>
          </div>
          </div>
          </div>
          </form>";

          if(isset($_POST["editUser" . $row_students['banner_id']])) {
            $bannerID=$_POST['bannerID'];
            $firstName=$_POST['firstName'];
            $lastName=$_POST['lastName'];
            $role=$_POST['role'];
            $status=$_POST['status'];
            $sql_edit_students = "UPDATE student SET first_name='$firstName', last_name='$lastName' WHERE banner_id='$bannerID'";
            $sql_edit_students_users = "UPDATE users SET user_type_id='$role', status='$status' WHERE banner_id='$bannerID'";
            $conn->query($sql_edit_students);
            $conn->query($sql_edit_students_users);
            echo "<meta http-equiv='refresh' content='0'>";
          }
        }

        while($row_staff = $result_staff->fetch_assoc()) {
          echo "<tr>
          <td class='mobile-hide'>" . $row_staff['banner_id'] . "</td>
          <td>" . $row_staff['last_name'] . "</td>
          <td>" . $row_staff['first_name'] . "</td>
          <td class='mobile-hide'>" . $row_staff['user_type_title'] . "</td>
          <td class='mobile-hide'>";

          if ($row_staff['status']==='y') {
            echo "Active";
          } else {
            echo "Inactive";
          }

          echo "</td>
          <td>
          <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editUser" . $row_staff['banner_id'] . "'>Edit</button>
          <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeUser" . $row_staff['banner_id'] . "'>Remove</button>
          </td>
          </tr>";

          echo "<form action='' method='post'>
          <div class='modal fade' id='removeUser" . $row_staff['banner_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
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
          <div class='col-sm-8'>" . $row_staff['banner_id'] . "</div>
          </div>
          <div class='row'>
          <div class='col-sm-4'><strong>First Name</strong></div>
          <div class='col-sm-8'>" . $row_staff['first_name'] . "</div>
          </div>
          <div class='row'>
          <div class='col-sm-4'><strong>Last Name</strong></div>
          <div class='col-sm-8'>" . $row_staff['last_name'] . "</div>
          </div>
          <div class='row'>
          <div class='col-sm-4'><strong>User Role</strong></div>
          <div class='col-sm-8'>" . $row_staff['user_type_title'] . "</div>
          </div>
          <div class='row'>
          <div class='col-sm-4'><strong>User Status</strong></div>
          <div class='col-sm-8'>";

          if ($row_staff['status']==='y') {
            echo "Active";
          } else {
            echo "Inactive";
          }

          echo "</div>
          </div>
          </div>
          </div>
          <div class='modal-footer'>
          <input type='hidden' name='banner-id' value='" . $row_staff['banner_id'] . "'>
          <button type='submit' class='btn btn-danger'>Remove User</button>
          <input type='hidden' name='removeUser" . $row_staff['banner_id'] . "'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
          </div>
          </div>
          </div>
          </div>
          </form>";

          if(isset($_POST["removeUser" . $row_staff['banner_id']])) {
            $bannerID=$_POST['banner-id'];
            $sql_delete_staff = "DELETE FROM users WHERE banner_id='$bannerID'";
            $conn->query($sql_delete_staff);
            echo "<meta http-equiv='refresh' content='0'>";
          }

          echo "<form action='' method='post'>
          <div class='modal fade' id='editUser" . $row_staff['banner_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
          <div class='modal-dialog'>
          <div class='modal-content'>
          <div class='modal-header'>
          <h4 class='modal-title'>Edit User</h4>
          </div>
          <div class='modal-body'>
          <p style='margin-bottom:25px;'>Enter your edits for the selected user in the text boxes below:</p>
          <div class='form-group'>
          <label>Banner ID</label>
          <input type='text' class='form-control' name='bannerID' value='" . $row_staff['banner_id'] . "' readonly>
          </div>
          <div class='form-group'>
          <label>First Name</label>
          <input type='text' class='form-control' name='firstName' value='" . $row_staff['first_name'] . "' required>
          </div>
          <div class='form-group'>
          <label>Last Name</label>
          <input type='text' class='form-control' name='lastName' value='" . $row_staff['last_name'] . "' required>
          </div>
          <div class='form-group'>
          <label>User Role</label>
          <select class='form-control' name='role' required>
          <option disabled>Select User Role</option>";

          $sql_roles = "SELECT * FROM user_type";
          $result_roles = $conn->query($sql_roles);

          while($row_roles = $result_roles->fetch_assoc()) {
            echo "<option value='" . $row_roles['user_type_id'] . "'";
            if ($row_roles['user_type_id']==$row_staff['user_type_id']) {
              echo " selected";
            }
            echo ">" . $row_roles['user_type_title'] . "</option>";
          }

          echo "</select>
          </div>
          <div class='form-group'>
          <label>User Status</label>
          <select class='form-control' name='status' required>
          <option disabled>Select User Status</option>
          <option value='y'";
          if ($row_staff['status']==='y') {
            echo " selected";
          }
          echo ">Active</option>
          <option value='n'";
          if ($row_staff['status']==='n') {
            echo " selected";
          }
          echo ">Inactive</option>
          </select>
          </div>
          </div>
          <div class='modal-footer'>
          <button type='submit' class='btn btn-primary'>Submit</button>
          <input type='hidden' name='editUser" . $row_staff['banner_id'] . "'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
          </div>
          </div>
          </div>
          </div>
          </form>";

          if(isset($_POST["editUser" . $row_staff['banner_id']])) {
            $bannerID=$_POST['bannerID'];
            $firstName=$_POST['firstName'];
            $lastName=$_POST['lastName'];
            $role=$_POST['role'];
            $status=$_POST['status'];
            $sql_edit_staff = "UPDATE staff SET first_name='$firstName', last_name='$lastName' WHERE banner_id='$bannerID'";
            $sql_edit_staff_users = "UPDATE users SET user_type_id='$role', status='$status' WHERE banner_id='$bannerID'";
            $conn->query($sql_edit_staff);
            $conn->query($sql_edit_staff_users);
            echo "<meta http-equiv='refresh' content='0'>";
          }
        }
        ?>

      </tbody>
    </table>

  </div>
</body>
</html>
