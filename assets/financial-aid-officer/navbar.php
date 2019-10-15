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
					<li id="student-information"><a href="student-information.php">Student Information</a></li>

					<li class="dropdown" id="manage-awards">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage Awards <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="award-assignment.php">Award Assignment</a></li>
							<li><a href="award-management.php">Award Management</a></li>
						</ul>
					</li>

					<li class="dropdown" id="manage-requirements">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage Requirements <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="requirement-assignment.php">Requirement Assignment</a></li>
							<li><a href="requirement-management.php">Requirement Management</a></li>
						</ul>
					</li>

					<li id="holds-management"><a href="holds-management.php">Manage Holds</a></li>
					<li class="logout-collapse"><a href="../assets/logout.php">Logout</a></li>
				</ul>
			</div>

		</div>
	</div>

</nav>
