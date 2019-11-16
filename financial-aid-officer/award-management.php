<?php
include '../assets/financial-aid-officer/connect.php';

$sql_funds = "SELECT * FROM fund ORDER BY fund_title ASC";
$result_funds = $conn->query($sql_funds);
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
              <input type='hidden' name='addFund'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <?php
    if(isset($_POST['addFund'])) {
      $fund=$_POST['fund'];
      $sql_create = "INSERT INTO fund (fund_title) VALUES ('$fund')";
      $conn->query($sql_create);
      echo "<meta http-equiv='refresh' content='0'>";
    }
    ?>

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

        <?php
        while($row_funds = $result_funds->fetch_assoc()) {
          echo "<tr>
          <td>" . $row_funds['fund_title'] . "</td>
          <td>
          <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#editAward" . $row_funds['fund_id'] . "'>Edit</button>
          <button type='button' class='btn btn-danger' data-toggle='modal' data-target='#removeAward" . $row_funds['fund_id'] . "'>Remove</button>
          </td>
          </tr>

          <form action='' method='post'>
          <div class='modal fade' id='editAward" . $row_funds['fund_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
          <div class='modal-dialog'>
          <div class='modal-content'>
          <div class='modal-header'>
          <h4 class='modal-title'>Edit Financial Aid Award</h4>
          </div>
          <div class='modal-body'>
          <p style='margin-bottom:25px;'>Enter your edits below for the selected financial aid award:</p>
          <div class='form-group'>
          <label>Fund Title</label>
          <input type='text' class='form-control' name='fund' value='" . $row_funds['fund_title'] . "' required>
          </div>
          </div>
          <div class='modal-footer'>
          <input type='hidden' name='fund-id' value='" . $row_funds['fund_id'] . "'>
          <button type='submit' class='btn btn-primary'>Submit</button>
          <input type='hidden' name='editFund" . $row_funds['fund_id'] . "'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
          </div>
          </div>
          </div>
          </div>
          </form>";

          if(isset($_POST["editFund" . $row_funds['fund_id']])) {
            $fundID=$_POST['fund-id'];
            $fundTitle=$_POST['fund'];
            $sql_update = "UPDATE fund SET fund_title='$fundTitle' WHERE fund_id='$fundID'";
            $conn->query($sql_update);
            echo "<meta http-equiv='refresh' content='0'>";
          }

          echo "<form action='' method='post'>
          <div class='modal fade' id='removeAward" . $row_funds['fund_id'] . "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
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
          <div class='col-sm-9'>" . $row_funds['fund_title'] . "</div>
          </div>
          </div>
          </div>
          <div class='modal-footer'>
          <input type='hidden' name='fund-id' value='" . $row_funds['fund_id'] . "'>
          <button type='submit' class='btn btn-danger'>Remove Award</button>
          <input type='hidden' name='removeFund" . $row_funds['fund_id'] . "'>
          <button type='button' class='btn btn-default' data-dismiss='modal'>Cancel</button>
          </div>
          </div>
          </div>
          </div>
          </form>";

          if(isset($_POST["removeFund" . $row_funds['fund_id']])) {
            $fundID=$_POST['fund-id'];
            $sql_delete = "DELETE FROM fund WHERE fund_id='$fundID'";
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
