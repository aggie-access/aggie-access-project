<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container" style="height:80px;">
		<div class="navbar-header">
			<a class="navbar-brand" href="dashboard.php"><img src="images/logo.png" style="width:325px;"></a>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="assets/logout.php" class="logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>
	<div class="container-fluid" style="background:#004684;">
		<div class="container">
			<div class="navbar-header welcome-message">
				Welcome, <?=$_SESSION['name']?>!
			</div>
			<ul class="nav navbar-nav nav-page-links">
				<li id="student-profile"><a href="student-profile.php">Profile</a></li>
				<li id="academic-transcript"><a href="academic-transcript.php">Transcript</a></li>
				<li id="class-schedule"><a href="class-schedule.php">Class Schedule</a></li>
				<li id="course-search"><a href="course-search.php">Course Search</a></li>
				<li id="course-registration"><a href="course-registration.php">Registration</a></li>
				<li id="financial-aid"><a href="financial-aid-award.php">Financial Aid</a></li>
			</ul>
		</div>
	</div>
</nav>
