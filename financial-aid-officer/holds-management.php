<?php
include '../assets/financial-aid-officer/connect.php';
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Holds Management</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#holds-management').addClass('active');
  });
  </script>
</head>

<body>

  <?php include '../assets/financial-aid-officer/navbar.php'; ?>

  <div class='container'>

    <h1>Holds Management</h1>
    <p style='margin-bottom:35px;'>Enter a student's banner ID to view information about the holds on their account.</p>

    <form action='' method='get' style='margin-bottom:30px;' id='form'>

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

    <?php
    if (isset($_GET["bannerID"])) {
      $banner_id=$_GET['bannerID'];

      $sql_user="SELECT user_type_title
      FROM users u JOIN user_type t ON (u.user_type_id=t.user_type_id)
      WHERE banner_id='$banner_id'";
      $result_user = $conn->query($sql_user);
      $row_user = $result_user->fetch_assoc();

      if ($result_user->num_rows > 0) {
        if ($row_user['user_type_title']==='Student') {
          $sql_student="SELECT banner_id, first_name, middle_initial, last_name, holds
          FROM student
          WHERE banner_id='$banner_id'";
          $result_student = $conn->query($sql_student);
          $row_student = $result_student->fetch_assoc();

          if ($row_student['holds']==='0') {
            echo "<button class='btn btn-danger pull-right' type='button' style='position:relative; top:20px;' data-toggle='modal' data-target='#placeHold'>Place Hold</span></button>

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
            <div class='col-sm-3'><strong>Banner ID</strong></div>
            <div class='col-sm-9'>" . $row_student['banner_id'] . "</div>
            </div>
            <div class='row'>
            <div class='col-sm-3'><strong>Student Name</strong></div>
            <div class='col-sm-9'>" . $row_student['first_name'] . " " . $row_student['middle_initial'] . ". " . $row_student['last_name'] . "</div>
            </div>
            </div>
            </div>
            <div class='modal-footer'>
            <input type='hidden' name='banner-id' value='" . $row_student['banner_id'] . "'>
            <button type='submit' class='btn btn-danger'>Place Hold</button>
            <input type='hidden' name='placeHold'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
            </div>
            </div>
            </div>
            </form>";

          } elseif ($row_student['holds']==='1') {
            echo "<button class='btn btn-success pull-right' type='button' style='position:relative; top:20px;' data-toggle='modal' data-target='#removeHold'>Remove Hold</span></button>

            <form action='' method='post'>
            <div class='modal fade' id='removeHold' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
            <div class='modal-content'>
            <div class='modal-header'>
            <h4 class='modal-title'>Remove Hold from Student Account</h4>
            </div>
            <div class='modal-body'>
            <p style='margin-bottom:25px;'>Are you sure that you would like to remove the hold on this student's account?</p>
            <div class='modal-data'>
            <div class='row'>
            <div class='col-sm-3'><strong>Banner ID</strong></div>
            <div class='col-sm-9'>" . $row_student['banner_id'] . "</div>
            </div>
            <div class='row'>
            <div class='col-sm-3'><strong>Student Name</strong></div>
            <div class='col-sm-9'>" . $row_student['first_name'] . " " . $row_student['middle_initial'] . ". " . $row_student['last_name'] . "</div>
            </div>
            </div>
            </div>
            <div class='modal-footer'>
            <input type='hidden' name='banner-id' value='" . $row_student['banner_id'] . "'>
            <button type='submit' class='btn btn-success'>Remove Hold</button>
            <input type='hidden' name='removeHold'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
            </div>
            </div>
            </div>
            </form>";
          }

          echo "<h3 style='margin-top:35px;'>Account Information</h3>
          <p style='margin-bottom:30px;'>This is the selected student's account information.</p>

          <div class='row row-no-gutters profile-grid first-row'>
          <div class='col-sm-3'>
          <strong>Banner ID</strong>
          </div>
          <div class='col-sm-9'>" . $row_student['banner_id'] . "</div>
          </div>

          <div class='row row-no-gutters profile-grid'>
          <div class='col-sm-3'>
          <strong>Student Name</strong>
          </div>
          <div class='col-sm-9'>" . $row_student['first_name'] . " " . $row_student['middle_initial'] . ". " . $row_student['last_name'] . "</div>
          </div>

          <div class='row row-no-gutters profile-grid last-row'>
          <div class='col-sm-3'>
          <strong>Holds</strong>
          </div>
          <div class='col-sm-9'>";

          if ($row_student['holds']==='0') {
            echo "The student does not have any holds placed on their record that will affect their financial aid award.";
          } elseif ($row_student['holds']==='1') {
            echo "The student does have a hold placed on their record that will affect their financial aid award.";
          }

          echo "</div>
          </div>";

          if(isset($_POST["placeHold"])) {
            $bannerID=$_POST['banner-id'];
            $sql_place = "UPDATE student SET holds='1' WHERE banner_id='$bannerID'";
            $conn->query($sql_place);
            echo "<meta http-equiv='refresh' content='0'>";
          }

          if(isset($_POST["removeHold"])) {
            $bannerID=$_POST['banner-id'];
            $sql_place = "UPDATE student SET holds='0' WHERE banner_id='$bannerID'";
            $conn->query($sql_place);
            echo "<meta http-equiv='refresh' content='0'>";
          }

        } else {
          echo "<div class='alert alert-danger'><strong>Error: </strong>The banner ID you have entered does not belong to a student. Please enter a valid student banner ID.</div>";
        }
      } else {
        echo "<div class='alert alert-danger'><strong>Error: </strong>The banner ID you have entered does not exist. Please enter a valid student banner ID.</div>";
      }
    }
    ?>

  </div>
</body>
</html>
