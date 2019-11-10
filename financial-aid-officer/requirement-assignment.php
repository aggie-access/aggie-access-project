<?php
include '../assets/financial-aid-officer/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Requirement Assignment</title>
  <?php include '../assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#manage-requirements").addClass("active");
  });
  </script>
</head>

<body>

  <?php include '../assets/financial-aid-officer/navbar.php';
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

  <div class="container">

    <h1>Requirement Assignment</h1>
    <p style='margin-bottom:35px;'>Select an award year and enter the student Banner ID to update/enter Financial Aid information.</p>

    <form action='requirement-assignment-dashboard.php' method='post' style='margin-bottom:30px;' id='form'>

      <div class='row'>
        <div class='col-sm-6'>
          <div class='form-group'>
            <label>Award Year</label>
            <select id='award-year' class='form-control' name='award-year'>
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
        <div class='col-sm-6'>
          <div class='form-group'>
            <label>Banner ID</label>
            <input type='text' class='form-control' name='studentbannerid' minlength='9' maxlength='9' size='9' value = '' required>
          </div>
        </div>
      </div>

      <button type='submit' class='btn btn-default'>Submit</button>

    </form>

  </div>
</body>
</html>
