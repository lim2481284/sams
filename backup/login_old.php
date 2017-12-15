<?php 
	
	include("assets/php/mysql_connect.inc.php"); 	
	include("assets/php/user_function.php"); 
?>


<!DOCTYPE html>

<html>
	<head>	

		<!--meta list-->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			
		<!--css for this page -->		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link href="assets/css/page-css/login.css" rel="stylesheet" type="text/css" media="all"/>	
		
	 </head>
	 
	<body>	
		<div id="login-button">
		  <img  class='filterWhite' src="assets/img/login-icon.png">
		  </img> 
		</div>
		<div id="container">
		  <h1>Log In</h1>
		  <span class="close-btn">
			<img src="circle_close_delete.png"></img>
		  </span>

		  <form action ="#" method = "post">
			<input type="student_ID" name="username" placeholder="Username">
			<input type="password" name="password" placeholder="Password">
			<button name='login'> Log in </button>
			
		</form>
		</div>
	</body>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.3/TweenMax.min.js"></script>

	<!--script for this page -->	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="assets/js/page-js/login.js"></script>	
	
</html>                     