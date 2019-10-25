<?php
include '../assets/admin/connect.php';
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Transcript Management Dashboard</title>
  <?php include '../assets/header.php'; ?>
  <script type='text/javascript'>
  $(document).ready(function(){
    $('#transcript-management').addClass('active');
  });
  </script>

  <style>
  th, td {
    vertical-align:middle!important;
  }
  .form-control {
    margin-bottom:10px;
  }
  label {
    margin-top:10px;
  }
  </style>
</head>

<body>

  <?php include '../assets/admin/navbar.php'; ?>

  <div class='container'>

    <h1>Transcript Management Dashboard</h1>
    <p>Below is a copy of the student's current academic transcript.</p>

    <h3 style='margin-bottom:20px; margin-top:35px;'>Student Information</h3>

    <div class='row row-no-gutters profile-grid first-row'>
      <div class='col-sm-3'>
        <strong>Banner ID</strong>
      </div>
      <div class='col-sm-9'>123456789</div>
    </div>

    <div class='row row-no-gutters profile-grid'>
      <div class='col-sm-3'>
        <strong>Student Name</strong>
      </div>
      <div class='col-sm-9'>Aggie T. Bulldog</div>
    </div>

    <div class='row row-no-gutters profile-grid'>
      <div class='col-sm-3'>
        <strong>Student Level</strong>
      </div>
      <div class='col-sm-9'>Undergraduate</div>
    </div>

    <div class='row row-no-gutters profile-grid'>
      <div class='col-sm-3'>
        <strong>Student Classification</strong>
      </div>
      <div class='col-sm-9'>Senior</div>
    </div>

    <div class='row row-no-gutters profile-grid'>
      <div class='col-sm-3'>
        <strong>College Affiliation</strong>
      </div>
      <div class='col-sm-9'>College of Science and Technology</div>
    </div>

    <div class='row row-no-gutters profile-grid'>
      <div class='col-sm-3'>
        <strong>Degree Type</strong>
      </div>
      <div class='col-sm-9'>Bachelor of Science</div>
    </div>

    <div class='row row-no-gutters profile-grid'>
      <div class='col-sm-3'>
        <strong>Major</strong>
      </div>
      <div class='col-sm-9'>Information Technology</div>
    </div>

    <div class='row row-no-gutters profile-grid last-row'>
      <div class='col-sm-3'>
        <strong>Graduation Year</strong>
      </div>
      <div class='col-sm-9'>2020</div>
    </div>

    <h3 style='margin-bottom:20px; margin-top:50px;'>Transcript</h3>

    <div class='row row-no-gutters transcript-grid first-row'>
      <div class='col-xs-3'>
        <strong>Course</strong>
      </div>
      <div class='col-xs-4'>
        <strong>Title</strong>
      </div>
      <div class='col-xs-2'>
        <strong>Credits</strong>
      </div>
      <div class='col-xs-2 mobile-hide'>
        <strong>Level</strong>
      </div>
      <div class='col-xs-1'>
        <strong>Grade</strong>
      </div>
    </div>

    <div class='row row-no-gutters transcript-grid'>
      <div class='col-xs-3'>CST 140</div>
      <div class='col-xs-4'>Introduction to Computer Programming</div>
      <div class='col-xs-2'>3.0</div>
      <div class='col-xs-2 mobile-hide'>Undergraduate</div>
      <div class='col-xs-1'>A</div>
    </div><div class='row row-no-gutters transcript-grid'>
      <div class='col-xs-3'>CST 150</div>
      <div class='col-xs-4'>Introduction to Computer Programming Laboratory</div>
      <div class='col-xs-2'>1.0</div>
      <div class='col-xs-2 mobile-hide'>Undergraduate</div>
      <div class='col-xs-1'>B-</div>
    </div><div class='row row-no-gutters transcript-grid'>
      <div class='col-xs-3'>CST 225</div>
      <div class='col-xs-4'>Computer Database Management I</div>
      <div class='col-xs-2'>3.0</div>
      <div class='col-xs-2 mobile-hide'>Undergraduate</div>
      <div class='col-xs-1'>A</div>
    </div><div class='row row-no-gutters transcript-grid'>
      <div class='col-xs-3'>CST 235</div>
      <div class='col-xs-4'>Computer Database Management I Laboratory</div>
      <div class='col-xs-2'>1.0</div>
      <div class='col-xs-2 mobile-hide'>Undergraduate</div>
      <div class='col-xs-1'>C</div>
    </div><div class='row row-no-gutters transcript-grid'>
      <div class='col-xs-3'>CST 285</div>
      <div class='col-xs-4'>Economic and Social Impacts of Information Technology</div>
      <div class='col-xs-2'>3.0</div>
      <div class='col-xs-2 mobile-hide'>Undergraduate</div>
      <div class='col-xs-1'>W</div>
    </div>

    <h3 style='margin-bottom:20px; margin-top:50px;'>Transcript Summary</h3>

    <div class='row row-no-gutters transcript-totals-grid first-row'>
      <div class='col-sm-4'>
        <strong>Attempted Credit Hours</strong>
      </div>
      <div class='col-sm-8'>11.0</div>
    </div>

    <div class='row row-no-gutters transcript-totals-grid'>
      <div class='col-sm-4'>
        <strong>Earned Credit Hours</strong>
      </div>
      <div class='col-sm-8'>8.0</div>
    </div>

    <div class='row row-no-gutters transcript-totals-grid'>
      <div class='col-sm-4'>
        <strong>Quality Points</strong>
      </div>
      <div class='col-sm-8'>28.70</div>
    </div>

    <div class='row row-no-gutters transcript-totals-grid last-row'>
      <div class='col-sm-4'>
        <strong>Overall Grade Point Average</strong>
      </div>
      <div class='col-sm-8'>3.588</div>
    </div>

  </div>
</body>
</html>
