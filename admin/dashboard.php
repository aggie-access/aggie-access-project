<?php include '../assets/admin/connect.php'; ?>

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

  <?php include '../assets/admin/navbar.php'; ?>

  <div class="container-fluid">
    <div class="row">
      <a href="user-management.php">
        <div class="col-sm-4 dashboard-odd">
          <div class="dashboard-link">
            <i class="fas fa-id-card" style="font-size:50px;"></i>
            <h2>User Management</h2>
            <p>Add new users or edit existing users.</p>
          </div>
        </div>
      </a>
      <a href="class-management.php">
        <div class="col-sm-4 dashboard-even">
          <div class="dashboard-link">
            <i class="fas fa-university" style="font-size:50px;"></i>
            <h2>Class Management</h2>
            <p>Manage classes offered by the university.</p>
          </div>
        </div>
      </a>
      <a href="section-management.php">
        <div class="col-sm-4 dashboard-odd">
          <div class="dashboard-link">
            <i class="fas fa-chalkboard-teacher" style="font-size:50px;"></i>
            <h2>Section Management</h2>
            <p>Manage class sections offered during each semester.</p>
          </div>
        </div>
      </a>
      <a href="registration-management.php">
        <div class="col-sm-4 dashboard-even">
          <div class="dashboard-link">
            <i class="fas fa-calendar-alt" style="font-size:50px;"></i>
            <h2>Registration Management</h2>
            <p>Manage student course registrations.</p>
          </div>
        </div>
      </a>
      <a href="grade-management.php">
        <div class="col-sm-4 dashboard-odd">
          <div class="dashboard-link">
            <i class="fas fa-book" style="font-size:50px;"></i>
            <h2>Grade Management</h2>
            <p>Add new grades or edit existing grades.</p>
          </div>
        </div>
      </a>
      <a href="transcript-management.php">
        <div class="col-sm-4 dashboard-even">
          <div class="dashboard-link">
            <i class="fas fa-graduation-cap" style="font-size:50px;"></i>
            <h2>Transcript Management</h2>
            <p>Manage student transcripts.</p>
          </div>
        </div>
      </a>
    </div>
  </div>

</body>

</html>
