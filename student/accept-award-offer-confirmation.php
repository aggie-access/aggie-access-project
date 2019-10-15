<?php
include '../assets/student/connect.php';

$banner_id=$_SESSION['username'];

$award_id=$_POST['id'];
$fall_amount=$_POST['fall'];
$spring_amount=$_POST['spring'];

$sql_accepted = "UPDATE award SET fall_amount_accepted='$fall_amount', spring_amount_accepted='$spring_amount' WHERE award_id='$award_id'";
$conn->query($sql_accepted);

$sql_aid = "SELECT award_id, fund_title, fall_amount_accepted, spring_amount_accepted, (fall_amount_accepted+spring_amount_accepted) AS total_amount
FROM award a JOIN fund f ON (a.fund_id=f.fund_id)
WHERE banner_id='$banner_id' AND award_id='$award_id'";
$result_aid = $conn->query($sql_aid);
$row_aid = $result_aid->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Award Offer Accepted</title>
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

    <h1>Award Offer Accepted</h1>
    <p style="margin-bottom:35px;">You have accepted the following financial aid award offer:</p>

    <?php
    echo "<div class='financial-aid-container'>
    <div class='financial-aid-grid'>
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
    <div class='col-sm-9'>$" . number_format($row_aid['fall_amount_accepted'], 2) . "</div>
    </div>

    <div class='row row-no-gutters financial-aid-row'>
    <div class='col-sm-3'>
    <strong>Spring Award Package</strong>
    </div>
    <div class='col-sm-9'>$" . number_format($row_aid['spring_amount_accepted'], 2) . "</div>
    </div>

    <div class='row row-no-gutters financial-aid-row'>
    <div class='col-sm-3'>
    <strong>Total Award Package</strong>
    </div>
    <div class='col-sm-9'>$" . number_format($row_aid['total_amount'], 2) . "</div>
    </div>
    </div>
    </div>";
    ?>

    <a href="financial-aid-award.php"><button class="btn btn-default">Back</button></a>

  </div>

</body>

</html>
