<?php
include '../assets/financial-aid-officer/connect.php';

$bannerID=$_GET['banner-id'];
$awardYear=$_GET['award-year'];

$sql_user="SELECT user_type_title
FROM users u JOIN user_type t ON (u.user_type_id=t.user_type_id)
WHERE banner_id='$bannerID'";
$result_user = $conn->query($sql_user);
$row_user = $result_user->fetch_assoc();

$sql_student="SELECT banner_id, first_name, middle_initial, last_name
FROM student
WHERE banner_id='$bannerID'";
$result_student = $conn->query($sql_student);
$row_student = $result_student->fetch_assoc();

$sql_year="SELECT school_year_name
FROM school_year
WHERE school_year_id='$awardYear'";
$result_year = $conn->query($sql_year);
$row_year = $result_year->fetch_assoc();

$sql_awards = "SELECT award_id, banner_id, a.fund_id, fund_title, fall_amount, spring_amount, fall_amount_accepted, spring_amount_accepted
FROM award a JOIN fund f ON (a.fund_id=f.fund_id)
WHERE banner_id='$bannerID' AND school_year_id='$awardYear'
ORDER BY fund_title ASC";
$result_awards = $conn->query($sql_awards);

$sql_funds = "SELECT * FROM fund ORDER BY fund_title ASC";
$result_funds = $conn->query($sql_funds);
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

    <?php
    if ($result_user->num_rows > 0) {
      if ($row_user['user_type_title']==='Student') {
        echo "<button class='btn btn-success pull-right' type='button' style='position:relative; top:20px;' data-toggle='modal' data-target='#newAward'>Add <span class='mobile-hide'>New Award</span></button>";
      }
    }
    ?>

    <h1>Award Assignment Dashboard</h1>

    <?php
    if ($result_user->num_rows > 0) {
      echo "<form action='' method='post'>
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
      <option selected disabled>Select Fund</option>";

      while($row_funds = $result_funds->fetch_assoc()) {
        echo "<option value='" . $row_funds['fund_id'] . "'>" . $row_funds['fund_title'] . "</option>";
      }

      echo "</select>
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
      <input type='hidden' name='banner-id' value='" . $bannerID . "'>
      <input type='hidden' name='award-year' value='" . $awardYear . "'>
      <button type='submit' class='btn btn-success'>Add Award</button>
      <input type='hidden' name='addAward'>
      <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
      </div>
      </div>
      </div>
      </div>
      </form>";

      if(isset($_POST["addAward"])) {
        $bannerID=$_POST['banner-id'];
        $awardYear=$_POST['award-year'];
        $fund=$_POST['fund'];
        $fallAmount=$_POST['fallAmountGiven'];
        $fallAmountAccepted=$_POST['fallAmountAccepted'];
        $springAmount=$_POST['springAmountGiven'];
        $springAmountAccepted=$_POST['springAmountAccepted'];

        $sql_create = "INSERT INTO award (banner_id, school_year_id, fund_id, fall_amount, spring_amount) VALUES ('$bannerID', '$awardYear', '$fund', '$fallAmount', '$springAmount')";
        $conn->query($sql_create);

        $sql_award_id="SELECT award_id FROM award ORDER BY award_id DESC LIMIT 1";
        $result_award_id = $conn->query($sql_award_id);
        $row_award_id = $result_award_id->fetch_assoc();

        $awardID=$row_award_id['award_id'];

        if (isset($fallAmountAccepted)) {
          $sql_update_fall = "UPDATE award SET fall_amount_accepted='$fallAmountAccepted' WHERE award_id='$awardID'";
          $conn->query($sql_update_fall);
        }

        if (isset($springAmountAccepted)) {
          $sql_update_spring = "UPDATE award SET spring_amount_accepted='$springAmountAccepted' WHERE award_id='$awardID'";
          $conn->query($sql_update_spring);
        }

        echo "<meta http-equiv='refresh' content='0'>";
      }

      if ($row_user['user_type_title']==='Student') {
        echo "<p style='margin-bottom:35px;'>You can add, edit, and delete financial aid awards for the selected student using the appropriate buttons below.</p>

        <h2 style='margin-bottom:0; margin-top:35px;'>" . $row_student['first_name'] . " " . $row_student['middle_initial'] . ". " . $row_student['last_name'] . " (" . $row_student['banner_id'] . ")</h2>
        <h3 style='margin-top:5px; margin-bottom:25px; border-bottom:1px solid #aaa; padding-bottom:10px;'>" . $row_year['school_year_name'] . " Award Year</h3>";

        if ($result_awards->num_rows > 0) {
          echo "<table class='table table-striped'>
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
          <tbody>";

          while($row_awards = $result_awards->fetch_assoc()) {
            echo "<tr>
            <td>" . $row_awards['fund_title'] . "</td>
            <td class='mobile-hide'>$" . number_format($row_awards['fall_amount'], 2) . "</td>
            <td class='mobile-hide'>";

            if (isset($row_awards['fall_amount_accepted'])) {
              echo "$" . number_format($row_awards['fall_amount_accepted'], 2);
            } else {
              echo "N/A";
            }

            echo "</td>
            <td class='mobile-hide'>$" . number_format($row_awards['spring_amount'], 2) . "</td>
            <td class='mobile-hide'>";

            if (isset($row_awards['spring_amount_accepted'])) {
              echo "$" . number_format($row_awards['spring_amount_accepted'], 2);
            } else {
              echo "N/A";
            }

            echo "</td>
            <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editAward" . $row_awards['award_id'] . "'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeAward" . $row_awards['award_id'] . "'>Remove</button>
            </td>
            </tr>

            <form action='' method='post'>
            <div class='modal fade' id='editAward" . $row_awards['award_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
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
            <option disabled>Select Fund</option>";

            $sql_edit_funds = "SELECT * FROM fund ORDER BY fund_title ASC";
            $result_edit_funds = $conn->query($sql_edit_funds);

            while($row_edit_funds = $result_edit_funds->fetch_assoc()) {
              echo "<option value='" . $row_edit_funds['fund_id'] . "'";
              if ($row_edit_funds['fund_id']===$row_awards['fund_id']) {
                echo " selected";
              }
              echo ">" . $row_edit_funds['fund_title'] . "</option>";
            }

            echo "</select>
            </div>
            <div class='form-group'>
            <label>Fall Amount Given</label>
            <input type='number' class='form-control' name='fallAmountGiven' min='0.01' step='0.01' value='" . $row_awards['fall_amount'] . "' required>
            </div>
            <div class='form-group'>
            <label>Fall Amount Accepted</label>
            <input type='number' class='form-control' name='fallAmountAccepted' min='0.01' step='0.01' value='" . $row_awards['fall_amount_accepted'] . "'>
            </div>
            <div class='form-group'>
            <label>Spring Amount Given</label>
            <input type='number' class='form-control' name='springAmountGiven' min='0.01' step='0.01' value='" . $row_awards['spring_amount'] . "' required>
            </div>
            <div class='form-group'>
            <label>Spring Amount Accepted</label>
            <input type='number' class='form-control' name='springAmountAccepted' min='0.01' step='0.01' value='" . $row_awards['spring_amount_accepted'] . "'>
            </div>
            </div>
            <div class='modal-footer'>
            <input type='hidden' name='award-id' value='" . $row_awards['award_id'] . "'>
            <button type='submit' class='btn btn-primary'>Submit</button>
            <input type='hidden' name='editAward" . $row_awards['award_id'] . "'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
            </div>
            </div>
            </div>
            </form>";

            if(isset($_POST["editAward" . $row_awards['award_id']])) {
              $awardID=$_POST['award-id'];
              $fund=$_POST['fund'];
              $fallAmount=$_POST['fallAmountGiven'];
              $fallAmountAccepted=$_POST['fallAmountAccepted'];
              $springAmount=$_POST['springAmountGiven'];
              $springAmountAccepted=$_POST['springAmountAccepted'];

              $sql_update = "UPDATE award SET fund_id='$fund', fall_amount='$fallAmount', spring_amount='$springAmount' WHERE award_id='$awardID'";
              $conn->query($sql_update);

              if (isset($fallAmountAccepted)) {
                $sql_update_fall = "UPDATE award SET fall_amount_accepted='$fallAmountAccepted' WHERE award_id='$awardID'";
                $conn->query($sql_update_fall);
              }

              if (isset($springAmountAccepted)) {
                $sql_update_spring = "UPDATE award SET spring_amount_accepted='$springAmountAccepted' WHERE award_id='$awardID'";
                $conn->query($sql_update_spring);
              }

              echo "<meta http-equiv='refresh' content='0'>";
            }

            echo "<form action='' method='post'>
            <div class='modal fade' id='removeAward" . $row_awards['award_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
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
            <div class='col-sm-7'>" . $row_awards['fund_title'] . "</div>
            </div>
            <div class='row'>
            <div class='col-sm-5'><strong>Fall Amount Given</strong></div>
            <div class='col-sm-7'>$" . number_format($row_awards['fall_amount'], 2) . "</div>
            </div>
            <div class='row'>
            <div class='col-sm-5'><strong>Fall Amount Accepted</strong></div>
            <div class='col-sm-7'>";

            if (isset($row_awards['fall_amount_accepted'])) {
              echo "$" . number_format($row_awards['fall_amount_accepted'], 2);
            } else {
              echo "N/A";
            }

            echo "</div>
            </div>
            <div class='row'>
            <div class='col-sm-5'><strong>Spring Amount Given</strong></div>
            <div class='col-sm-7'>$" . number_format($row_awards['spring_amount'], 2) . "</div>
            </div>
            <div class='row'>
            <div class='col-sm-5'><strong>Spring Amount Accepted</strong></div>
            <div class='col-sm-7'>";

            if (isset($row_awards['spring_amount_accepted'])) {
              echo "$" . number_format($row_awards['spring_amount_accepted'], 2);
            } else {
              echo "N/A";
            }

            echo "</div>
            </div>
            </div>
            </div>
            <div class='modal-footer'>
            <input type='hidden' name='award-id' value='" . $row_awards['award_id'] . "'>
            <button type='submit' class='btn btn-danger'>Remove Award</button>
            <input type='hidden' name='removeAward" . $row_awards['award_id'] . "'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
            </div>
            </div>
            </div>
            </form>";

            if(isset($_POST["removeAward" . $row_awards['award_id']])) {
              $awardID=$_POST['award-id'];
              $sql_delete = "DELETE FROM award WHERE award_id='$awardID'";
              $conn->query($sql_delete);
              echo "<meta http-equiv='refresh' content='0'>";
            }
          }

          echo "</tbody>
          </table>";

        } else {
          echo "<div class='alert alert-danger'><strong>Error: </strong>The student you have selected has not been awarded any financial aid awards during the selected award year.</div>";
        }
      } else {
        echo "<div class='alert alert-danger'><strong>Error: </strong>The banner ID you have entered does not belong to a student. Please enter a valid student banner ID.</div>";
      }
    } else {
      echo "<div class='alert alert-danger'><strong>Error: </strong>The banner ID you have entered does not exist. Please enter a valid student banner ID.</div>";
    }
    ?>

  </div>
</body>
</html>
