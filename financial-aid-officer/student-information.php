<?php
include '../assets/financial-aid-officer/connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Student Information</title>
  <?php include '../assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#student-information").addClass("active");
  });
  </script>

  <script type="text/javascript">
  $(document).ready(function() {
    $("#form").submit(function(e) {
      e.preventDefault();
      $("#studentInformation").show();
    });
  });
  </script>
</head>

<body>

  <?php include '../assets/financial-aid-officer/navbar.php'; ?>

  <div class="container">

    <h1>Student Information</h1>
    <p style='margin-bottom:35px;'>Enter a student's banner ID to view their personal information and eligibility status.</p>

    <form action='' method='post' style='margin-bottom:30px;' id='form'>

      <div class='row'>
        <div class='col-sm-6'>
          <div class='form-group'>
            <label>Banner ID</label>
            <input type='text' class='form-control' name='bannerID' minlength='9' maxlength='9' size='9' required>
          </div>
        </div>
      </div>

      <button type='submit' class='btn btn-default'>Submit</button>

    </form>

    <div id='studentInformation' style='display:none;'>
      <h3 style='margin-top:35px;'>Personal Information</h3>
      <p style="margin-bottom:30px;">This is the student's personal profile information that is included in the university's directory.</p>

      <div class="row row-no-gutters profile-grid first-row">
        <div class="col-sm-3">
          <strong>Name</strong>
        </div>
        <div class="col-sm-9">Aggie T. Bulldog</div>
      </div>

      <div class="row row-no-gutters profile-grid">
        <div class="col-sm-3">
          <strong>Address</strong>
        </div>
        <div class="col-sm-9">1601 East Market Street<br>Greensboro, NC 27401</div>
      </div>

      <div class="row row-no-gutters profile-grid">
        <div class="col-sm-3">
          <strong>Birth Date</strong>
        </div>
        <div class="col-sm-9">March 9, 2019</div>
      </div>

      <div class="row row-no-gutters profile-grid">
        <div class="col-sm-3">
          <strong>Phone</strong>
        </div>
        <div class="col-sm-9">336-334-7500</div>
      </div>

      <div class="row row-no-gutters profile-grid last-row">
        <div class="col-sm-3">
          <strong>Email</strong>
        </div>
        <div class="col-sm-9">aggie@aggies.ncat.edu</div>
      </div>

      <h3>Student Information</h3>
      <p style="margin-bottom:30px;">This is the student's profile information that is also included in the university's directory.</p>

      <div class="row row-no-gutters profile-grid first-row">
        <div class="col-sm-3">
          <strong>Level</strong>
        </div>
        <div class="col-sm-9">Undergraduate</div>
      </div>

      <div class="row row-no-gutters profile-grid">
        <div class="col-sm-3">
          <strong>Classification</strong>
        </div>
        <div class="col-sm-9">Senior</div>
      </div>

      <div class="row row-no-gutters profile-grid">
        <div class="col-sm-3">
          <strong>College Affiliation</strong>
        </div>
        <div class="col-sm-9">College of Science and Technology</div>
      </div>

      <div class="row row-no-gutters profile-grid">
        <div class="col-sm-3">
          <strong>Degree Type</strong>
        </div>
        <div class="col-sm-9">Bachelor of Science</div>
      </div>

      <div class="row row-no-gutters profile-grid">
        <div class="col-sm-3">
          <strong>Major</strong>
        </div>
        <div class="col-sm-9">Information Technology</div>
      </div>

      <div class="row row-no-gutters profile-grid last-row">
        <div class="col-sm-3">
          <strong>Graduation Year</strong>
        </div>
        <div class="col-sm-9">2020</div>
      </div>

      <h3>Eligibility Status Information</h3>
      <p style="margin-bottom:30px;">This is the student's financial aid eligibility status information as determined by their academic progress.</p>

      <div class="row row-no-gutters profile-grid first-row">
        <div class="col-sm-3">
          <strong>Holds</strong>
        </div>
        <div class="col-sm-9">The student does not have any holds placed on their record that will affect their financial aid award.</div>
      </div>

      <div class="row row-no-gutters profile-grid">
        <div class="col-sm-3">
          <strong>Cumulative GPA</strong>
        </div>
        <div class="col-sm-9">3.588</div>
      </div>

      <div class="row row-no-gutters profile-grid">
        <div class="col-sm-3">
          <strong>Degree Program Completion Rate</strong>
        </div>
        <div class="col-sm-9">72.73%</div>
      </div>

      <div class="row row-no-gutters profile-grid last-row">
        <div class="col-sm-3">
          <strong>Total Attempted Credit Hours</strong>
        </div>
        <div class="col-sm-9">The student has attempted <strong>11.0</strong> hours in their current degree program, and they have earned <strong>8.0</strong>.</div>
      </div>
    </div>


  </div>
</body>
</html>
