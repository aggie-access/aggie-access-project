<?php include '../assets/financial-aid-officer/connect.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Dashboard</title>
  <?php include '../assets/header.php'; ?>
  <script type="text/javascript">
  $(document).ready(function(){
    $("#dashboard").addClass("active");
  });
  </script>
</head>

<style>
.nav-page-links {
  display:none;
}
.navbar-toggle {
  display:none;
}
</style>

<body style="margin-top:120px;">

  <?php include '../assets/financial-aid-officer/navbar.php'; ?>

  <div class="container-fluid">
    <div class="row">
      <a href="student-information.php">
        <div class="col-sm-4 dashboard-odd">
          <div class="dashboard-link">
            <i class="fas fa-id-card" style="font-size:50px;"></i>
            <h2>Student Information</h2>
            <p>Manage student information.</p>
          </div>
        </div>
      </a>
      <a href="award-assignment.php">
        <div class="col-sm-4 dashboard-even">
          <div class="dashboard-link">
            <i class="fas fa-dollar-sign" style="font-size:50px;"></i>
            <h2>Award Assignment</h2>
            <p>Assign financial aid awards to students.</p>
          </div>
        </div>
      </a>
      <a href="award-management.php">
        <div class="col-sm-4 dashboard-odd">
          <div class="dashboard-link">
            <i class="fas fa-archive" style="font-size:50px;"></i>
            <h2>Award Management</h2>
            <p>Manage student financial aid awards.</p>
          </div>
        </div>
      </a>
      <a href="requirement-assignment.php">
        <div class="col-sm-4 dashboard-even">
          <div class="dashboard-link">
            <i class="fas fa-tasks" style="font-size:50px;"></i>
            <h2>Requirement Assignment</h2>
            <p>Assign requirements to financial aid awards.</p>
          </div>
        </div>
      </a>
      <a href="requirement-management.php">
        <div class="col-sm-4 dashboard-odd">
          <div class="dashboard-link">
            <i class="fas fa-clipboard-check" style="font-size:50px;"></i>
            <h2>Requirement Management</h2>
            <p>Manage financial aid award requirements.</p>
          </div>
        </div>
      </a>
      <a href="holds-management.php">
        <div class="col-sm-4 dashboard-even">
          <div class="dashboard-link">
            <i class="fas fa-flag" style="font-size:50px;"></i>
            <h2>Holds Management</h2>
            <p>Manage holds placed on student accounts.</p>
          </div>
        </div>
      </a>
    </div>
  </div>

</body>

</html>
