<?php
include 'assets/connect.php';

$banner_id=$_SESSION['username'];

$award_id=$_GET['id'];

$sql_aid = "SELECT award_id, fund_title, fall_amount, spring_amount, (fall_amount+spring_amount) AS total_amount
FROM award a JOIN fund f ON (a.fund_id=f.fund_id)
WHERE banner_id='$banner_id' AND award_id='$award_id'";
$result_aid = $conn->query($sql_aid);
$row_aid = $result_aid->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Accept Award Offer</title>
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

    <h1>Accept Award Offer</h1>
    <p style="margin-bottom:35px;">You have chosen to accept the following financial aid award offer:</p>

    <?php
    if ($result_aid->num_rows > 0) {
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
      <div class='col-sm-9'>$" . number_format($row_aid['fall_amount'], 2) . "</div>
      </div>

      <div class='row row-no-gutters financial-aid-row'>
      <div class='col-sm-3'>
      <strong>Spring Award Package</strong>
      </div>
      <div class='col-sm-9'>$" . number_format($row_aid['spring_amount'], 2) . "</div>
      </div>

      <div class='row row-no-gutters financial-aid-row'>
      <div class='col-sm-3'>
      <strong>Total Award Package</strong>
      </div>
      <div class='col-sm-9'>$" . number_format($row_aid['total_amount'], 2) . "</div>
      </div>
      </div>
      </div>";
    }
    ?>

    <p style='margin-bottom:35px;'>You may choose to accept the full amount of this financial aid offer, or you may choose to accept a partial amount. Please enter the amount of the financial aid offer that you have chosen to accept for the fall and spring semester in the text boxes below:</p>

    <form action="accept-award-offer-confirmation.php" method="post" style="margin-bottom:30px;">
      <input type="hidden" name="id" value="<?php echo $award_id; ?>">
      <div class="row">
        <div class="col-sm-4">
          <div class="form-group">
            <label>Fall Award Amount</label>
            <input type="number" class="form-control" name="fall" min="0.01" step="0.01" max="<?php echo $row_aid['fall_amount']; ?>" required>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label>Spring Award Amount</label>
            <input type="number" class="form-control" name="spring" min="0.01" step="0.01" max="<?php echo $row_aid['spring_amount']; ?>" required>
          </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
      <button type="reset" class="btn btn-default">Reset</button>
    </form>

  </div>

</body>

</html>
