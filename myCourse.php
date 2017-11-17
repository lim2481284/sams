<?php 
	
	include("assets/php/mysql_connect.inc.php"); 	
?>



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
		<link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
		<link href="assets/css/page-css/myCourse.css" rel="stylesheet"/>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.0/sweetalert2.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="assets/css/responsive/myCourse.css" media="screen and (max-width : 768px)">

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
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="content all-icons">
										<button class='btn btn-default createCourse'>Create  </button>
										<div class="row courseListSection">
										</div>
									</div>
								</div>
							</div>

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
	
	
	<!--   JS for this  page   -->	
	<script src="assets/js/bootstrap-notify.js"></script>	
	<script src="assets/js/page-js/myCourse.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.0/sweetalert2.all.js"></script>
	
	<!--   Grab course data   -->	
	<?php 
		
		include("assets/php/course_function.php"); 	
	?>

	
</html>