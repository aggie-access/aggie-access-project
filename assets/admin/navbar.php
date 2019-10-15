<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container navbar-top">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="dashboard.php"><img src="../images/logo.png" class="navbar-logo"></a>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<li><a href="../assets/logout.php" class="logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
		</ul>
	</div>

	<div class="container-fluid" style="background:#004684;">
		<div class="container">
			<div class="navbar-header welcome-message">
				Welcome, <?=$_SESSION['name']?>!
			</div>

			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right nav-page-links" style="margin-top:0;">
					<li id="user-management"><a href="user-management.php">Users</a></li>
					<li id="class-management"><a href="class-management.php">Classes</a></li>
					<li id="section-management"><a href="section-management.php">Sections</a></li>
					<li id="registration-management"><a href="registration-management.php">Course Registrations</a></li>
					<li id="grade-management"><a href="grade-management.php">Grades</a></li>
					<li id="transcript-management"><a href="transcript-management.php">Transcripts</a></li>
					<li class="logout-collapse"><a href="../assets/logout.php">Logout</a></li>
				</ul>
			</div>

		</div>
	</div>

</nav>
