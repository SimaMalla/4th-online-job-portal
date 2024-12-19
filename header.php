<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="navbar-header topic">
			<!-- <div class="job-logo">Job Finder</div> -->
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
				data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">eJob Portal</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<!-- <a class="navbar-brand" href="index.php"><img src="..images/logo.png" alt=""></a> -->
		</div>
		<!--/.navbar-header-->
		<div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" style="height: 1px;">
			<div class="job-logo">Job Finder</div>
			<ul class="nav navbar-nav">
				<!-- <li><a href="register.php"><b>Register</b></a></li>
				<li><a href="login.php"><b>Login</b></a></li> -->
				<?php

				session_start();
				if (isset($_SESSION['roletype'])) {
					if ($_SESSION['roletype'] == 1) {
						echo '
					<li><a href="index.php">Home Page</a></li>
					<li><a href="viewappjobs.php">View Application</a></li>
					<li><a href="categories.php">Categories</a></li>
					<li><a href="job.php">Add Jobs</a></li>
					<li><a href="viewjobs.php">View Jobs</a></li>
					<li><a href="logout.php">Logout</a></li>';
					} elseif ($_SESSION['roletype'] == 2) {
						echo '
							<li><a href="index.php">Home Page</a></li>
							
							<li><a href="viewjobs.php">View Jobs</a></li>
					<li><a href="logout.php">Logout</a></li>';
					} else {
						echo '
							<li><a href="index.php">Home Page</a></li>
							
							<li><a href="viewjobs.php">View Jobs</a></li>
							<li><a href="register.php">Register</a></li>
							<li><a href="login.php">Login</a></li>
					';
					}

				} else {
					echo '
					<li><a href="index.php">Home Page</a></li>
					
					<li><a href="viewjobs.php">View Jobs</a></li>
					<li><a href="register.php">Register</a></li>
					<li><a href="login.php">Login</a></li>
			';
				}
				?>

			</ul>
		</div>
		<div class="clearfix"> </div>
	</div>
	<!--/.navbar-collapse-->
</nav>