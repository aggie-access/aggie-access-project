<?php
include 'assets/connect.php';

$banner_id=$_SESSION['username'];

$sql_year = "SELECT * FROM school_year ORDER BY school_year_name DESC";
$result_year = $conn->query($sql_year);

$year_id='';
$result_aid='';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $year_id=$_POST['award-year'];
  $sql_aid = "SELECT fund_title, fall_amount, spring_amount, (fall_amount+spring_amount) AS total_amount
  FROM award JOIN fund ON (award.fund_id=fund.fund_id)
  WHERE banner_id='$banner_id' AND school_year_id='$year_id'";
  $result_aid = $conn->query($sql_aid);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Financial Aid</title>
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
    <p style="margin-bottom:35px;">Select an award year below to view your financial aid information. This will include any grants, loans, and scholarships that you may have received.</p>

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
      echo "<p style='margin:10px 0 30px;'>Your financial aid award for the selected school year is displayed below. This information includes the types of awards you received, the status of those awards, the amount each award will apply towards the fall semester, the amount each award will apply towards the spring semester, and the total award package you received for the school year from each fund.</p>";
      echo "<table class='table table-striped' style='margin-bottom:35px;'>";
      echo "<thead>";
      echo "<tr>";
      echo "</tr>";
      echo "<th>Fund</th>";
      echo "<th>Status</th>";
      echo "<th>Fall Award Package</th>";
      echo "<th>Spring Award Package</th>";
      echo "<th>Total Award Package</th>";
      echo "</thead>";
      echo "<tbody>";

      while($row_aid = $result_aid->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row_aid['fund_title'] . "</td>";
        echo "<td>Accepted</td>";
        echo "<td>$" . number_format($row_aid['fall_amount'], 2) . "</td>";
        echo "<td>$" . number_format($row_aid['spring_amount'], 2) . "</td>";
        echo "<td>$" . number_format($row_aid['total_amount'], 2) . "</td>";
        echo "</tr>";
      }

      echo "</tbody>";
      echo "</table>";
    }
    ?>

  </div>

</body>

</html>
