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

$sql_requirements="SELECT s.award_id, a.fund_id, fund_title, s.requirement_id, requirement_title, completion_status
FROM award_requirement_status s JOIN award a ON (s.award_id=a.award_id) JOIN fund_requirements r ON (s.requirement_id=r.requirement_id) JOIN fund f ON (a.fund_id=f.fund_id)
WHERE banner_id='$bannerID' AND school_year_id='$awardYear'
ORDER BY fund_title ASC, requirement_title ASC";
$result_requirements = $conn->query($sql_requirements);

$sql_fund_requirements="SELECT r.fund_id, fund_title, requirement_id, requirement_title
FROM fund_requirements r JOIN fund f ON (r.fund_id=f.fund_id)
WHERE r.fund_id IN (SELECT a.fund_id FROM award a JOIN fund f ON (a.fund_id=f.fund_id) WHERE banner_id='$bannerID' AND school_year_id='$awardYear')";
$result_fund_requirements = $conn->query($sql_fund_requirements);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Requirement Assignment Dashboard</title>
  <?php include '../assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#manage-requirements").addClass("active");
  });
  </script>

  <style>
  th, td {
    vertical-align:middle!important;
  }
  .btn {
    margin-bottom:5px;
  }
  </style>
</head>

<body>

  <?php include '../assets/financial-aid-officer/navbar.php'; ?>

  <div class="container">

    <?php
    if ($result_student->num_rows > 0) {
      echo "<button class='btn btn-success pull-right' type='button' style='position:relative; top:20px;' data-toggle='modal' data-target='#newAward'>Add <span class='mobile-hide'>New Award Requirement</span></button>";
    }
    ?>

    <form action='' method='post'>
      <div class='modal fade' id='newAward' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Assign New Financial Aid Award Requirement</h4>
            </div>
            <div class='modal-body'>
              <?php
              if ($result_fund_requirements->num_rows > 0) {
                echo "<p style='margin-bottom:25px;'>Fill in the form below to add a new financial aid award requirement to the student's account.</p>
                <div class='form-group'>
                <label>Award Requirement</label>
                <select class='form-control' name='requirement' required>
                <option selected disabled>Select Award Requirement</option>";
                while($row_fund_requirements = $result_fund_requirements->fetch_assoc()) {
                  echo "<option value='" . $row_fund_requirements['requirement_id'] . "'>" . $row_fund_requirements['fund_title'] . " - " . $row_fund_requirements['requirement_title'] . "</option>";
                }

                echo "</select>
                </div>";

              } else {
                echo "<div class='alert alert-danger'><strong>Error: </strong>The selected student has not been assigned any financial aid awards during the selected award year that have requirements.</div>";
              }
              ?>


            </div>
            <div class='modal-footer'>
              <input type='hidden' name='banner-id' value='<?php echo $bannerID; ?>'>
              <input type='hidden' name='award-year' value='<?php echo $awardYear; ?>'>
              <?php
              if ($result_fund_requirements->num_rows > 0) {
                echo "<button type='submit' class='btn btn-success'>Assign Award Requirement</button>";
              }
              ?>
              <input type='hidden' name='addRequirement'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <?php
    if(isset($_POST["addRequirement"])) {
      $bannerID=$_POST['banner-id'];
      $awardYear=$_POST['award-year'];
      $requirement=$_POST['requirement'];

      $sql_fund="SELECT fund_id
      FROM fund_requirements
      WHERE requirement_id='$requirement'";
      $result_fund = $conn->query($sql_fund);
      $row_fund = $result_fund->fetch_assoc();

      $fund=$row_fund['fund_id'];

      $sql_award="SELECT award_id
      FROM award
      WHERE banner_id='$bannerID' AND school_year_id='$awardYear' AND fund_id='$fund'";
      $result_award = $conn->query($sql_award);
      $row_award = $result_award->fetch_assoc();

      $award=$row_award['award_id'];

      $sql_create = "INSERT INTO award_requirement_status (award_id, requirement_id, completion_status) VALUES ('$award', '$requirement', 'n')";
      $conn->query($sql_create);

      echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>

    <h1>Requirement Assignment Dashboard</h1>
    <p style='margin-bottom:35px;'>You may add, edit, or remove financial aid award requirements from the selected student's account by using the appropriate buttons.</p>

    <?php
    if ($result_user->num_rows > 0) {
      if ($row_user['user_type_title']==='Student') {
        echo "<h2 style='margin-bottom:0; margin-top:35px;'>" . $row_student['first_name'] . " " . $row_student['middle_initial'] . ". " . $row_student['last_name'] . " (" . $row_student['banner_id'] . ")</h2>
        <h3 style='margin-top:5px; margin-bottom:25px; border-bottom:1px solid #aaa; padding-bottom:10px;'>" . $row_year['school_year_name'] . " Award Year</h3>";
        if ($result_requirements->num_rows > 0) {
          echo "<table class='table table-striped'>
          <thead>
          <tr>
          <th>Fund Title</th>
          <th>Requirement Type</th>
          <th class='mobile-hide'>Status</th>
          <th>Actions</th>
          </tr>
          </thead>
          <tbody>";

          while($row_requirements = $result_requirements->fetch_assoc()) {
            echo "<tr>
            <td>" . $row_requirements['fund_title'] . "</td>
            <td>" . $row_requirements['requirement_title'] . "</td>
            <td class='mobile-hide'>";

            if ($row_requirements['completion_status']==='y') {
              echo "Complete";
            } elseif ($row_requirements['completion_status']==='n') {
              echo "Not Complete";
            }

            echo "</td>
            <td>
            <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editRequirement" . $row_requirements['award_id'] . $row_requirements['requirement_id'] . "'>Edit</button>
            <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeRequirement" . $row_requirements['award_id'] . $row_requirements['requirement_id'] . "'>Remove</button>
            </td>
            </tr>

            <form action='' method='post'>
            <div class='modal fade' id='editRequirement" . $row_requirements['award_id'] . $row_requirements['requirement_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
            <div class='modal-content'>
            <div class='modal-header'>
            <h4 class='modal-title'>Edit Requirement</h4>
            </div>
            <div class='modal-body'>
            <p style='margin-bottom:25px;'>Enter your edits for the selected award requirement in the form below:</p>
            <div class='modal-data'>
            <div class='form-group row'>
            <div class='col-sm-4'><strong>Fund Title</strong></div>
            <div class='col-sm-8'>
            <input type='text' class='form-control' name='fund' value='" . $row_requirements['fund_title'] . "' disabled>
            </div>
            </div>
            <div class='form-group row'>
            <div class='col-sm-4'><strong>Requirement Type</strong></div>
            <div class='col-sm-8'>
            <input type='text' class='form-control' name='requirement' value='" . $row_requirements['requirement_title'] . "' disabled>
            </div>
            </div>
            <div class='form-group row'>
            <div class='col-sm-4'><strong>Status</strong></div>
            <div class='col-sm-8'>
            <select class='form-control' name='status' required>
            <option disabled>Select Requirement Status</option>
            <option value='y'";
            if ($row_requirements['completion_status']==='y') {
              echo " selected";
            }
            echo ">Complete</option>
            <option value='n'";
            if ($row_requirements['completion_status']==='n') {
              echo " selected";
            }
            echo ">Not Complete</option>
            </select>
            </div>
            </div>
            </div>
            </div>
            <div class='modal-footer'>
            <input type='hidden' name='award-id' value='" . $row_requirements['award_id'] . "'>
            <input type='hidden' name='requirement-id' value='" . $row_requirements['requirement_id'] . "'>
            <button type='submit' class='btn btn-primary'>Submit</button>
            <input type='hidden' name='editRequirement" . $row_requirements['award_id'] . $row_requirements['requirement_id'] . "'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
            </div>
            </div>
            </div>
            </form>";

            if(isset($_POST["editRequirement" . $row_requirements['award_id'] . $row_requirements['requirement_id']])) {
              $awardID=$_POST['award-id'];
              $requirementID=$_POST['requirement-id'];
              $status=$_POST['status'];

              $sql_update = "UPDATE award_requirement_status SET completion_status='$status' WHERE award_id='$awardID' AND requirement_id='$requirementID'";
              $conn->query($sql_update);

              echo "<meta http-equiv='refresh' content='0'>";
            }

            echo "<form action='' method='post'>
            <div class='modal fade' id='removeRequirement" . $row_requirements['award_id'] . $row_requirements['requirement_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
            <div class='modal-dialog'>
            <div class='modal-content'>
            <div class='modal-header'>
            <h4 class='modal-title'>Remove Requirement</h4>
            </div>
            <div class='modal-body'>
            <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following requirement from this student's account?</p>
            <div class='modal-data'>
            <div class='row'>
            <div class='col-sm-4'><strong>Fund Title</strong></div>
            <div class='col-sm-8'>" . $row_requirements['fund_title'] . "</div>
            </div>
            <div class='row'>
            <div class='col-sm-4'><strong>Requirement Title</strong></div>
            <div class='col-sm-8'>" . $row_requirements['requirement_title'] . "</div>
            </div>
            </div>
            </div>
            <div class='modal-footer'>
            <input type='hidden' name='award-id' value='" . $row_requirements['award_id'] . "'>
            <input type='hidden' name='requirement-id' value='" . $row_requirements['requirement_id'] . "'>
            <button type='submit' class='btn btn-danger'>Remove Requirement</button>
            <input type='hidden' name='removeRequirement" . $row_requirements['award_id'] . $row_requirements['requirement_id'] . "'>
            <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
            </div>
            </div>
            </div>
            </form>";

            if(isset($_POST["removeRequirement" . $row_requirements['award_id'] . $row_requirements['requirement_id']])) {
              $awardID=$_POST['award-id'];
              $requirementID=$_POST['requirement-id'];
              $sql_delete = "DELETE FROM award_requirement_status WHERE award_id='$awardID' AND requirement_id='$requirementID'";
              $conn->query($sql_delete);
              echo "<meta http-equiv='refresh' content='0'>";
            }
          }

          echo "</tbody>
          </table>";

        } else {
          echo "<div class='alert alert-danger'><strong>Error: </strong>The student you have selected has not been assigned any financial aid award requirements during the selected award year.</div>";
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
