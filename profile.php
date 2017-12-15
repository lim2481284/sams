

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
		<link href="assets/css/page-css/profile.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="assets/css/responsive/profile.css" media="screen and (max-width : 768px)">

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
							<div class="col-md-8">
								<div class="card">
									<div class="header">
										<h4 class="title">Edit Profile</h4>
									</div>
									<div class="content">
										<form action ='#' method = "post">
											<div class="row">
												<div class="col-md-5">
													<div class="form-group">
														<label>ID Number</label>
														<input type="text" class="form-control cardID" name='cardID'  placeholder="Student ID" value=""  required>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Username</label>
														<input type="text" class="form-control username" name=username placeholder="Username" value="" disabled>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Email address</label>
														<input name='email' type="email" class="form-control email" placeholder="Email"  required> 
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label>Gender </label>
														<select  class="form-control gender" placeholder="" value="" name='gender'  required>
															<option value='' selected disabled> Gender </option>
															<option value='male'> Male </option>
															<option value='female'> Female </option>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label>Contact number</label>
														<input name='contact' type="text" class="form-control contact" placeholder="Last Name" value=""  required>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>Address</label>
														<input name ='address' type="text" class="form-control address" placeholder="Home Address" value=""  required>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label>About Me</label>
														<textarea name='about' rows="5" class="form-control about" placeholder="Here can be your description" ></textarea>
													</div>
												</div>
											</div>
											
											<button type="submit" class="btn btn-info btn-fill pull-right" name='update'>Update Profile</button>
											<button type="button" class="btn btn-default pull-right changePasswordBtn" name='update'>Change Password</button>
											<div class="clearfix"></div>
										</form>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="card card-user">
									<div class="image">
										<img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>										
									</div>
									
									<div class="content">
										<div class="author">
											<a href="#">
												<form id='pictureForm' action="#" method="post" enctype="multipart/form-data">
													<img id='uploadedImage' class=" avatar border-gray" src="" alt="..."/>
													<div class="file-input-wrapper">
													  <button class="btn btn-default">Upload Picture</button>
													  <input type="file" name="fileToUpload"  class='profileFileUpload' onchange="readURL(this);"/>
													  
													</div>
													<input type='hidden' name='picture'/>
													<input type='hidden' class='pictureName' name='pictureName'/>
													
												</form>												
											</a>
											 <h4 class="usernameTitle"><br /></h4>
											 
										</div>
										<p class="userDescription text-center about">
										</p>
									</div>
									<hr>

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
	<script src="http://malsup.github.com/jquery.form.js"></script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.0/sweetalert2.all.js"></script>
	<script src="assets/js/main.js"></script>
	
	<!--   JS for this  page   -->	
	<script src="assets/js/bootstrap-notify.js"></script>	
	<script src="assets/js/page-js/profile.js"></script>
	
	<!--   Grab user data   -->	
	<?php 
		include("assets/php/mysql_connect.inc.php"); 	
		include("assets/php/profile_function.php"); 	
	?>

</html>
