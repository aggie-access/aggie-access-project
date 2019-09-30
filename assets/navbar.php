<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container navbar-top">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="dashboard.php"><img src="images/logo.png" class="navbar-logo"></a>
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

			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right nav-page-links" style="margin-top:0;">
					<li id="student-profile"><a href="student-profile.php">Profile</a></li>
					<li id="academic-transcript"><a href="academic-transcript.php">Transcript</a></li>
					<li id="class-schedule"><a href="class-schedule.php">Class Schedule</a></li>
					<li id="course-search"><a href="course-search.php">Course Search</a></li>
					<li id="course-registration"><a href="course-registration.php">Registration</a></li>
					<li class="dropdown" id="financial-aid">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Financial Aid <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="financial-aid-award.php">Award</a></li>
							<li><a href="financial-aid-eligibility-status.php">Eligibility Status</a></li>
						</ul>
					</li>
					<li class="logout-collapse"><a href="assets/logout.php">Logout</a></li>
				</ul>
			</div>

		</div>
	</div>

</nav>
