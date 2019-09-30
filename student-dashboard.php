<?php include 'assets/connect.php'; 
$user = $_GET['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Dashboard</title>
  <?php include 'assets/header.php'; ?>
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
  <p>Welcome back <?php $user; ?> </p>
  <?php include 'assets/navbar.php'; ?>

  <div class="container-fluid">
    <div class="row">
      <a href="student-profile.php">
        <div class="col-sm-4 dashboard-odd">
          <div class="dashboard-link">
            <i class="fas fa-id-card" style="font-size:50px;"></i>
            <h2>Student Profile</h2>
            <p>Review your student profile.</p>
          </div>
        </div>
      </a>
      <a href="academic-transcript.php">
        <div class="col-sm-4 dashboard-even">
          <div class="dashboard-link">
            <i class="fas fa-user-graduate" style="font-size:50px;"></i>
            <h2>Academic Transcript</h2>
            <p>Review your academic transcript.</p>
          </div>
        </div>
      </a>
      <a href="class-schedule.php">
        <div class="col-sm-4 dashboard-odd">
          <div class="dashboard-link">
            <i class="fas fa-calendar-alt" style="font-size:50px;"></i>
            <h2>Class Schedule</h2>
            <p>Review your class schedule.</p>
          </div>
        </div>
      </a>
      <a href="course-search.php">
        <div class="col-sm-4 dashboard-even">
          <div class="dashboard-link">
            <i class="fas fa-search" style="font-size:50px;"></i>
            <h2>Course Search</h2>
            <p>Search for courses for the upcoming semester.</p>
          </div>
        </div>
      </a>
      <a href="course-registration.php">
        <div class="col-sm-4 dashboard-odd">
          <div class="dashboard-link">
            <i class="fas fa-university" style="font-size:50px;"></i>
            <h2>Registration</h2>
            <p>Register for courses for the upcoming semester.</p>
          </div>
        </div>
      </a>
      <a href="financial-aid-award.php">
        <div class="col-sm-4 dashboard-even">
          <div class="dashboard-link">
            <i class="fas fa-dollar-sign" style="font-size:50px;"></i>
            <h2>Financial Aid</h2>
            <p>Review your current financial aid status.</p>
          </div>
        </div>
      </a>
    </div>
  </div>

</body>

</html>
