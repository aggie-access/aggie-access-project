<?php
include '../assets/financial-aid-officer/connect.php';

$sql_requirements = "SELECT requirement_id, requirement_title, requirement_description, requirement_url, r.fund_id, fund_title
FROM fund_requirements r JOIN fund f ON (r.fund_id=f.fund_id)
ORDER BY fund_title ASC, requirement_title ASC";
$result_requirements = $conn->query($sql_requirements);

$sql_funds = "SELECT * FROM fund ORDER BY fund_title ASC";
$result_funds = $conn->query($sql_funds);
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Requirement Management</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#manage-requirements').addClass('active');
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

  <div class='container'>

    <button class='btn btn-success pull-right' type='button' style='position:relative; top:20px;' data-toggle='modal' data-target='#newAward'>Add <span class='mobile-hide'>New Award Requirement</span></button>

    <form action='' method='post'>
      <div class='modal fade' id='newAward' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Add New Financial Aid Award Requirement</h4>
            </div>
            <div class='modal-body'>
              <p style='margin-bottom:25px;'>Fill in the form below to add a new financial aid award requirements to the system:</p>
              <div class='form-group'>
                <label>Fund Title</label>
                <select class='form-control' name='fund' required>
                  <option selected disabled>Select Fund Title</option>

                  <?php
                  while($row_funds = $result_funds->fetch_assoc()) {
                    echo "<option value='" . $row_funds['fund_id'] . "'>" . $row_funds['fund_title'] . "</option>";
                  }
                  ?>

                </select>
              </div>
              <div class='form-group'>
                <label>Requirement Type</label>
                <input type='text' class='form-control' name='requirement' required>
              </div>
              <div class='form-group'>
                <label>Requirement Description</label>
                <textarea class='form-control' name='description' required></textarea>
              </div>
              <div class='form-group'>
                <label>Requirement URL</label>
                <input type='url' class='form-control' name='url' required>
              </div>
            </div>
            <div class='modal-footer'>
              <button type='submit' class='btn btn-success'>Add New Requirement</button>
              <input type='hidden' name='addRequirement'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <?php
    if(isset($_POST['addRequirement'])) {
      $fund=$_POST['fund'];
      $requirement=$_POST['requirement'];
      $description=$_POST['description'];
      $url=$_POST['url'];
      $sql_create = "INSERT INTO fund_requirements (requirement_title, requirement_description, requirement_url, fund_id) VALUES ('$requirement', '$description', '$url', '$fund')";
      $conn->query($sql_create);
      echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>

    <h1>Requirement Management</h1>
    <p style='margin-bottom:35px;'>You may add, edit, or delete financial aid award requirements to the system by using the appropriate buttons below.</p>

    <table class='table table-striped'>
      <thead>
        <tr>
          <th style='width:175px;'>Fund</th>
          <th style='width:175px;'>Requirement</th>
          <th class='mobile-hide'>Description</th>
          <th style='width:275px;'>Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php
        while($row_requirements = $result_requirements->fetch_assoc()) {
          echo "<tr>
          <td>" . $row_requirements['fund_title'] . "</td>
          <td>" . $row_requirements['requirement_title'] . "</td>
          <td class='mobile-hide'>" . $row_requirements['requirement_description'] . "</td>
          <td>
          <a href='" . $row_requirements['requirement_url'] . "' target='_blank'><button type='button' class='btn btn-info'>FAFSA URL</button></a>
          <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editRequirement" . $row_requirements['requirement_id'] . "'>Edit</button>
          <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeRequirement" . $row_requirements['requirement_id'] . "'>Remove</button>
          </td>
          </tr>

          <form action='' method='post'>
          <div class='modal fade' id='editRequirement" . $row_requirements['requirement_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
          <div class='modal-dialog'>
          <div class='modal-content'>
          <div class='modal-header'>
          <h4 class='modal-title'>Edit Award Requirement</h4>
          </div>
          <div class='modal-body'>
          <p style='margin-bottom:25px;'>Enter your edits for the following financial aid award requirement below:</p>
          <div class='modal-data'>
          <div class='row form-group'>
          <div class='col-sm-4'><strong>Fund Title</strong></div>
          <div class='col-sm-8'>
          <select class='form-control' name='fund' required>
          <option disabled>Select Fund Title</option>";

          $sql_edit_funds = "SELECT * FROM fund ORDER BY fund_title ASC";
          $result_edit_funds = $conn->query($sql_edit_funds);

          while($row_edit_funds = $result_edit_funds->fetch_assoc()) {
            echo "<option value='" . $row_edit_funds['fund_id'] . "'";
            if ($row_requirements['fund_id']===$row_edit_funds['fund_id']) {
              echo " selected";
            }
            echo ">" . $row_edit_funds['fund_title'] . "</option>";
          }

          echo "</select>
          </div>
          </div>
          <div class='row form-group'>
          <div class='col-sm-4'><strong>Requirement Type</strong></div>
          <div class='col-sm-8'>
          <input type='text' class='form-control' name='requirement' value='" . $row_requirements['requirement_title'] . "' minlength='1' maxlength='255' required>
          </div>
          </div>
          <div class='row form-group'>
          <div class='col-sm-4'><strong>Description</strong></div>
          <div class='col-sm-8'>
          <textarea class='form-control' name='description' required>" . $row_requirements['requirement_description'] . "</textarea>
          </div>
          </div>
          <div class='row form-group'>
          <div class='col-sm-4'><strong>Requirement URL</strong></div>
          <div class='col-sm-8'>
          <input type='url' class='form-control' name='url' value='" . $row_requirements['requirement_url'] . "' required>
          </div>
          </div>
          </div>
          </div>
          <div class='modal-footer'>
          <input type='hidden' name='requirement-id' value='" . $row_requirements['requirement_id'] . "'>
          <button type='submit' class='btn btn-primary'>Submit</button>
          <input type='hidden' name='editRequirement" . $row_requirements['requirement_id'] . "'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
          </div>
          </div>
          </div>
          </div>
          </form>";

          if(isset($_POST["editRequirement" . $row_requirements['requirement_id']])) {
            $requirementID=$_POST['requirement-id'];
            $fund=$_POST['fund'];
            $requirement=$_POST['requirement'];
            $description=$_POST['description'];
            $url=$_POST['url'];
            $sql_update = "UPDATE fund_requirements SET requirement_title='$requirement', requirement_description='$description', requirement_url='$url', fund_id='$fund' WHERE requirement_id='$requirementID'";
            $conn->query($sql_update);
            echo "<meta http-equiv='refresh' content='0'>";
          }

          echo "<form action='' method='post'>
          <div class='modal fade' id='removeRequirement" . $row_requirements['requirement_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
          <div class='modal-dialog'>
          <div class='modal-content'>
          <div class='modal-header'>
          <h4 class='modal-title'>Remove Requirement</h4>
          </div>
          <div class='modal-body'>
          <p style='margin-bottom:25px;'>Are you sure that you would like to remove the following financial aid award requirement from the system?</p>
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
          <input type='hidden' name='requirement-id' value='" . $row_requirements['requirement_id'] . "'>
          <button type='submit' class='btn btn-danger'>Remove Requirement</button>
          <input type='hidden' name='removeRequirement" . $row_requirements['requirement_id'] . "'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
          </div>
          </div>
          </div>
          </div>
          </form>";

          if(isset($_POST["removeRequirement" . $row_requirements['requirement_id']])) {
            $requirement=$_POST['requirement-id'];
            $sql_delete = "DELETE FROM fund_requirements WHERE requirement_id='$requirement'";
            $conn->query($sql_delete);
            echo "<meta http-equiv='refresh' content='0'>";
          }
        }
        ?>

      </tbody>
    </table>

  </div>
</body>
</html>
