<?php
include '../assets/admin/connect.php';
?>

<!DOCTYPE html>
<html lang='en'>

<head>
  <title>Section Management Dashboard</title>
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

    <table class='table table-striped'>
      <thead>
        <tr>
          <th>Banner ID</th>
          <th>First Name</th>
          <th class='mobile-hide'>Last Name</th>
          <th class='mobile-hide' style='width:200px;'>Major</th>
          <th class='mobile-hide'>Graduation Date</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>123456789</td>
          <td>Aggie</td>
          <td class='mobile-hide'>Bulldog</td>
          <td class='mobile-hide'>Information Technology</td>
          <td class='mobile-hide'>2020</td>
        </tr>
    </tbody>
    <table class='table table-striped'>
      <thead>
        <tr>
          <th>Course</th>
          <th>Title</th>
          <th class='mobile-hide'>Credit</th>
          <th class='mobile-hide' style='width:200px;'>Level</th>
          <th class='mobile-hide'>Grade</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>CST140</td>
          <td>Introduction to Computer Programming</td>
          <td class='mobile-hide'>3.0</td>
          <td class='mobile-hide'>Undergraduate</td>
          <td class='mobile-hide'>A</td>
        </tr>
        <tr>
          <td>CST150</td>
          <td>Introduction to Computer Programming Laboratory</td>
          <td class='mobile-hide'>1.0</td>
          <td class='mobile-hide'>Undergraduate</td>
          <td class='mobile-hide'>B-</td>
        </tr>
        <tr>
          <td>CST225</td>
          <td>Computer Database Management I</td>
          <td class='mobile-hide'>3.0</td>
          <td class='mobile-hide'>Undergraduate</td>
          <td class='mobile-hide'>A</td>
        </tr>
        <tr>
          <td>CST235</td>
          <td>Computer Database Management I Laboratory</td>
          <td class='mobile-hide'>1.0</td>
          <td class='mobile-hide'>Undergraduate</td>
          <td class='mobile-hide'>C</td>
        </tr>
        <tr>
          <td>CST285</td>
          <td>Economic and Social Impacts of Information Technology</td>
          <td class='mobile-hide'>3.0</td>
          <td class='mobile-hide'>Undergraduate</td>
          <td class='mobile-hide'>W</td>
        </tr>
    </tbody>

  </div>
</body>
</html>