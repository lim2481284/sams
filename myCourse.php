

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
				
				<!-- Main content for create course section  -->	
				<div class="content createCourseSection">
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
				
				<!-- Main content for display course section  -->	
				<div class="content displayCourseSection">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="content all-icons">
										
										<input class='courseKey' type='hidden'/>
										<button class='btn btn-default leftBtn backBtn'>Back  </button>
										<button class='btn btn-default leftBtn editCourse'>Edit course  </button>
										<button class='btn btn-default leftBtn addAssignment'>Add assignment  </button>	
										<div class='fileSection leftBtn'>
											<form id='fileForm' action="#" method="post" enctype="multipart/form-data">
												<input name='courseID' class='courseID' type='hidden'/>
												<div class="file-input-wrapper">
												  <button class='btn btn-default addMaterial'>Add material  </button>
												  <input type="file" name="fileToUpload"  class='materialFileUpload' onchange="readURL(this);"/>
												  
												</div>
												<input type='hidden' name='file'/>												
											</form>
										</div>
										<br><br><br>
										<div class='topCourseSection'>	
											<div class="cardInside">									
												<div class="content all-icons">								 								 
													<div class="font-icon-detail infoBox"><i class="pe-7s-note2"></i>
													  <input type="text" class='infoCourseCode'  value="">
													  <label class='infoCourseName'></label>
													  <hr>
													  <label class='infoCourseDescription'></label>
													  <input name='courseID' class='courseID' type='hidden'/>
													</div>						
												</div>									
											</div>																									
										</div>		
										<div class='courseMenu'> 
											<a class='courseMenuList assignmentBtn menuActive' href='#'> Assignment </a> 
											|
											<a class='courseMenuList materialBtn' href='#'> Material </a> 											
										</div>
										<div class='col-sm-1'></div>
										<div class='tableSection assignmentSection col-sm-10'>
											<table class='tableTable courseInfoAssignmentList'>
												<tr class='t_header'>
													<th class='t_1'>
														Assignment 
													</th>
													<th  class='t_2'>
														Deadline 
													</th>
													<th  class='t_3'>
														Action 
													</th>
												</tr>
												

											</table>
											<br><br><br><br><br><br><br><br><br>
										</div>	
										<div class='tableSection materialSection col-sm-10'>
											<table class='tableTable courseMaterialList'>
												<tr class='t_header'>
													<th class='t_1'>
														Material Name
													</th>
													<th  class='t_2'>
														 
													</th>
													<th  class='t_3'>
														Action 
													</th>
												</tr>
												
											</table>
											<br><br><br><br><br><br><br><br><br>
										</div>											
										<div class='col-sm-1'></div>
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
		include("assets/php/mysql_connect.inc.php"); 	
		include("assets/php/course_function.php"); 	
	?>

	
</html>
