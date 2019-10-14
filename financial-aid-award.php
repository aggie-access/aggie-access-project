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
  FROM award a JOIN fund f ON (a.fund_id=f.fund_id)
  WHERE banner_id='$banner_id' AND school_year_id='$year_id'";
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

    <h1>Financial Aid Award</h1>
    <p style="margin-bottom:35px;">Select an award year below to view your financial aid award offers. This will include any grants, loans, and scholarships that you may have received.</p>

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
      echo "<p style='margin:10px 0 30px;'>Your financial aid award for the selected school year is displayed below. This information includes the types of awards you received, the status of those awards, the amount each award will apply towards the fall semester, the amount each award will apply towards the spring semester, and the total award package you received for the school year from each fund.</p>
      <div class='financial-aid-container'>";
      while($row_aid = $result_aid->fetch_assoc()) {
        if ($row_aid['fall_amount_accepted']!='0' AND $row_aid['spring_amount_accepted']!='0') {
          echo "<div class='financial-aid-grid'>
          <div class='row row-no-gutters financial-aid-row'>
          <div class='col-sm-3'>
          <strong>Fund</strong>
          </div>
          <div class='col-sm-9'>" . $row_aid['fund_title'] . "</div>
          </div>

          <div class='row row-no-gutters financial-aid-row'>
          <div class='col-sm-3'>
          <strong>Fall Award Package</strong>
          </div>
          <div class='col-sm-9'>$";

          if (empty($row_aid['fall_amount_accepted']) AND empty($row_aid['spring_amount_accepted'])) {
            echo number_format($row_aid['fall_amount'], 2);
          } else {
            echo number_format($row_aid['fall_amount_accepted'], 2);
          }

          echo "</div>
          </div>

          <div class='row row-no-gutters financial-aid-row'>
          <div class='col-sm-3'>
          <strong>Spring Award Package</strong>
          </div>
          <div class='col-sm-9'>$";

          if (empty($row_aid['fall_amount_accepted']) AND empty($row_aid['spring_amount_accepted'])) {
            echo number_format($row_aid['spring_amount'], 2);
          } else {
            echo number_format($row_aid['spring_amount_accepted'], 2);
          }

          echo "</div>
          </div>

          <div class='row row-no-gutters financial-aid-row'>
          <div class='col-sm-3'>
          <strong>Total Award Package</strong>
          </div>
          <div class='col-sm-9'>$";

          if (empty($row_aid['fall_amount_accepted']) AND empty($row_aid['spring_amount_accepted'])) {
            echo number_format($row_aid['total_amount'], 2);
          } else {
            $total_accepted_amount=$row_aid['fall_amount_accepted']+$row_aid['spring_amount_accepted'];
            echo number_format($total_accepted_amount, 2);
          }

          echo "</div>
          </div>

          <div class='row row-no-gutters financial-aid-row'>
          <div class='col-sm-3'>
          <strong>Decision</strong>
          </div>
          <div class='col-sm-9'>";

          if (empty($row_aid['fall_amount_accepted']) AND empty($row_aid['spring_amount_accepted'])) {
            echo "<a href='accept-award-offer.php?id=" . $row_aid['award_id'] . "'><button type='button' class='btn btn-success'>Accept</button></a>
            <a href='decline-award-offer.php?id=" . $row_aid['award_id'] . "'><button type='button' class='btn btn-danger'>Decline</button></a>";
          } else {
            echo "Accepted";
          }
          echo "</div>
          </div>
          </div>";
        }
      }
      echo "</div>";
    }
    ?>

  </div>

</body>

</html>
