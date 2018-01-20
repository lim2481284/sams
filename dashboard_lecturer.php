<!doctype html>
<html lang="en">

	<head>

		<meta charset="utf-8" />
		<title>SAMS U10</title>
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<meta name="viewport" content="width=device-width" />

		<!-- CSS for all page   -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/light-bootstrap-dashboard.css?v=1.4.0" rel="stylesheet"/>
		<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
		<link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
		<link href="assets/css/main.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="assets/css/responsive/main.css" media="screen and (max-width : 768px)">

		<!-- CSS for this page   -->
		<link href="assets/css/animate.min.css" rel="stylesheet"/>
		<link href="assets/css/page-css/dashboard.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="assets/css/responsive/dashboard.css" media="screen and (max-width : 768px)">
		<link href='assets/css/fullcalendar.css' rel='stylesheet' />
		<link href='assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />



	</head>

	<body>

		<div class="wrapper">

			<!-- Sidebar section  -->
			<div class='sidemenu-section'></div>

			<div class="main-panel">

				<!-- Top menu section  -->
				<div class='topmenu-section'></div>

				<!-- Main content section  -->
				<div class="content">

						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#notificationTab">Notification</a></li>
							<li><a data-toggle="tab" href="#calanderTab">Calander</a></li>
							<li><a data-toggle="tab" href="#studentTab">My student</a></li>
						</ul>

						<div class="tab-content">
							<div id="notificationTab" class="tab-pane fade in active">
								<h3> No notification </h3>
							</div>
							<div id="calanderTab" class="tab-pane fade">
								<br><br>
  							<div id='calendar'></div>
							</div>
							<div id="studentTab" class="tab-pane fade">
								<select class='courseList form-control'>
										<option value='' disabled selected>Select course ... </option>
								</select>
								<div class='tableContent'>

								</div>

								<br>


							</div>
						</div>


				</div>

			</div>

		</div>

	</body>


	<!--   JS for all page   -->
	<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/main.js" type="text/javascript"></script>
	<script src="assets/js/light-bootstrap-dashboard.js?v=1.4.0"></script>
	<script src="assets/js/main.js"></script>

	<!--   JS for this  page
	<script src="assets/js/bootstrap-notify.js"></script>	 -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.0/sweetalert2.all.js"></script>
	<script src='assets/js/jquery.min.js'></script>
	<script src='assets/js/moment.min.js'></script>
	<script src='assets/js/fullcalendar.js'></script>
	<script src="assets/js/page-js/dashboard.js"></script>

	<!--php connection-->
	<?php
		include("assets/php/mysql_connect.inc.php");
		include("assets/php/dashboard_function.php");
		include("assets/php/check_profile.php");
	?>



</html>
