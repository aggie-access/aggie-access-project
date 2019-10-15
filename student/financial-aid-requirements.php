<?php
include '../assets/student/connect.php';

$banner_id=$_SESSION['username'];

$sql_year = "SELECT * FROM school_year ORDER BY school_year_name DESC";
$result_year = $conn->query($sql_year);

$year_id='';
$result_aid='';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $year_id=$_POST['award-year'];
  $sql_requirements = "SELECT fund_title, requirement_title, requirement_description, requirement_url, completion_status
  FROM award a JOIN fund f ON (a.fund_id=f.fund_id) JOIN fund_requirements r ON (f.fund_id=r.fund_id) JOIN award_requirement_status s ON (a.award_id=s.award_id AND r.requirement_id=s.requirement_id)
  WHERE banner_id='$banner_id' AND school_year_id='$year_id' AND (fall_amount_accepted!=0 OR fall_amount_accepted IS NULL) AND (spring_amount_accepted!=0 OR spring_amount_accepted IS NULL);";
  $result_requirements = $conn->query($sql_requirements);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Financial Aid Requirements</title>
  <?php include '../assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#financial-aid").addClass("active");
  });
  </script>

</head>

<body>

  <?php include '../assets/student/navbar.php'; ?>

  <div class="container">

    <h1>Financial Aid Requirements</h1>
    <p style="margin-bottom:35px;">Select an award year below to view your financial aid requirements. This only includes financial aid awards that you have accepted.</p>

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
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($result_requirements->num_rows > 0) {
        echo "<p style='margin:10px 0 30px;'>Your financial aid requirements for the selected school year are displayed below. You must complete these requirements in order to receive your financial aid award.</p>
        <div class='financial-aid-container'>";
        while($row_requirements = $result_requirements->fetch_assoc()) {
          echo "<div class='financial-aid-grid'>
          <div class='row row-no-gutters financial-aid-row'>
          <div class='col-sm-3'>
          <strong>Fund</strong>
          </div>
          <div class='col-sm-9'>" . $row_requirements['fund_title'] . "</div>
          </div>

          <div class='row row-no-gutters financial-aid-row'>
          <div class='col-sm-3'>
          <strong>Requirement</strong>
          </div>
          <div class='col-sm-9'>" . $row_requirements['requirement_title'] . "</div>
          </div>

          <div class='row row-no-gutters financial-aid-row'>
          <div class='col-sm-3'>
          <strong>Description</strong>
          </div>
          <div class='col-sm-9'>" . $row_requirements['requirement_description'] . "</div>
          </div>

          <div class='row row-no-gutters financial-aid-row'>
          <div class='col-sm-3'>
          <strong>Completion Status</strong>
          </div>
          <div class='col-sm-9'>";

          if ($row_requirements['completion_status']==='y') {
            echo "Completed";
          } elseif ($row_requirements['completion_status']==='n') {
            echo "Not completed";
          }

          echo "</div>
          </div>";

          if ($row_requirements['completion_status']==='n') {
            echo "<div class='row row-no-gutters financial-aid-row'>
            <div class='col-sm-3'></div>
            <div class='col-sm-9'><a href='" . $row_requirements['requirement_url'] . "' target='_blank'><button type='button' class='btn btn-primary'>Complete this Requirement on FAFSA.gov</button></a></div>
            </div></div>";
          } elseif ($row_requirements['completion_status']==='y') {
            echo "</div>";
          }
        }
      } else {
        echo "<p style='margin:10px 0 30px;'>You do not have any financial aid requirements to complete for the selected school year.</p>";
      }
    }
    ?>

  </div>

</body>

</html>
