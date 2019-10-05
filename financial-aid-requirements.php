<?php
include 'assets/connect.php';

$banner_id=$_SESSION['username'];

$sql_year = "SELECT * FROM school_year ORDER BY school_year_name DESC";
$result_year = $conn->query($sql_year);

$year_id='';
$result_aid='';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $year_id=$_POST['award-year'];
  $sql_aid = "SELECT award_id, fund_title, fall_amount, spring_amount, (fall_amount+spring_amount) AS total_amount, fall_amount_accepted, spring_amount_accepted
  FROM award JOIN fund ON (award.fund_id=fund.fund_id)
  WHERE banner_id='$banner_id' AND school_year_id='$year_id' and fund_title like '%Loan%'";
  $result_aid = $conn->query($sql_aid);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Financial Aid Award</title>
  <?php include 'assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#financial-aid").addClass("active");
  });
  </script>

</head>

<body>

  <?php include 'assets/navbar.php'; ?>

  <div class="container">

    <h1>Loan Requirements</h1>
    <p style="margin-bottom:35px;">Select an award year below to view your Loan Requirements. This only includes Loans you may have accepted.</p>

    <form method="post">
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            <label>Award Year</label>
            <select id='award-year' class='form-control' name='award-year' onchange='this.form.submit();'>
              <option disabled selected value>Select Award Year</option>
              <?php
              while($row_year = $result_year->fetch_assoc()) {
                echo "<option ";
                if ($year_id == $row_year['school_year_id'] ) {
                  echo 'selected ';
                }
                echo "value='" . $row_year['school_year_id'] . "'>" . $row_year['school_year_name'] . " Award Year</option>";
              }
              ?>
            </select>
          </div>
        </div>
      </div>
    </form>

    <?php
    if ($result_aid->num_rows > 0) {
      echo "<p style='margin:10px 0 30px;'>Your financial aid loan(s) for the selected school year are displayed below. Complete the below requirements to accept loan offer.</p>
      <div class='financial-aid-container'>";
      while($row_aid = $result_aid->fetch_assoc()) {
        if ($row_aid['fall_amount_accepted']!='0' AND $row_aid['spring_amount_accepted']!='0') {
          echo "<div class='financial-aid-grid'>
          <div class='row row-no-gutters financial-aid-row'>
          <div class='col-sm-3'>
          <strong>Fund</strong>
          </div>
          <div class='col-sm-9'>" . $row_aid['fund_title'] . "</div>
          <div class='row row-no-gutters financial-aid-row'>
          <div class='col-sm-3'>
          <strong>Sign Promissory Note</strong>
          </div>
            <div class='col-sm-9'>
            <div class='checkbox1'>
            <input class type='checkbox' value=''</div>";

          echo "</div>
          </div>

          <div class='row row-no-gutters financial-aid-row'>
          <div class='col-sm-3'>
          <strong>Complete Loan Responsibility Video</strong>
          </div>
          <div class='col-sm-9'>
          <div class='checkbox2'>
          <input class type='checkbox' value=''</div>";

          echo "</div>
          </div>

          <div class='row row-no-gutters financial-aid-row'>
          <div class='col-sm-3'>
          <strong>place holder for another requirement</strong>
          </div>
          <div class='col-sm-9'>
          <div class='checkbox3'>
          <input class type='checkbox' value=''</div>";

          echo "</div>
          </div>
          </div>";
        }
      }
      echo "</div>";
    }
    else {
      echo "<p style='margin:10px 0 30px;'> No Loans were either offered or accepted.</p>
      <div class='financial-aid-container'>";
    }
    ?>

  </div>

</body>

</html>
