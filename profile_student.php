
<link href="assets/css/page-css/profile_user.css" rel="stylesheet">
<link href="assets/css/main_user.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<div class='menu'></div>

<div class='bodyContent'>
	<form action ='#' method = "post">
		<div class="form-group">
			<div class='label'>ID Number</div>
			<input type="text" class="form-control cardID" name='cardID'  placeholder="Student ID" value=""  required>
		</div>
		<div class="form-group">
			<div class='label'>Username</div>
			<input type="text" class="form-control username" name=username placeholder="Username" value="" disabled>
		</div>

		<div class="form-group">
			<div class='label'>Email address</div>
			<input name='email' type="email" class="form-control email" placeholder="Email"  required>
		</div>


		<div class="form-group">
			<div class='label'>Gender </div>
			<select  class="form-control gender" placeholder="" value="" name='gender'  required>
				<option value='' selected disabled> Gender </option>
				<option value='male'> Male </option>
				<option value='female'> Female </option>
			</select>
		</div>


		<div class="form-group">
			<div class='label'>Contact number</div>
			<input name='contact' type="text" class="form-control contact" placeholder="Last Name" value=""  required>
		</div>



		<div class="form-group">
			<div class='label'>Address</div>
			<input name ='address' type="text" class="form-control address" placeholder="Home Address" value=""  required>
		</div>



		<div class="form-group">
			<div class='label'>About Me</div>
			<textarea name='about' rows="5" class="form-control about" placeholder="Here can be your description" ></textarea>
		</div>


		<button type="submit" class="btn btn-info btn-fill pull-right" name='update'>Update Profile</button>
		<button type="button" class="btn btn-default pull-right changePasswordBtn" name='update'>Change Password</button>
		<div class="clearfix"></div>
	</form>
	<br><br><br><br><br><br>

	<!-- profile picture
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
	-->

	</div>
	<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script>
	$(document).ready(function(){

		//Side menu and top menu load function
		$('.menu').load('assets/php/menu_student.php',function(){
				$('.profile').addClass('current');
		});

	});
	</script>
