<!DOCTYPE html>
<html lang="en" >
<head>


	<!--meta list-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<!--Title -->	
	<title>SAMS</title>
		
	<!--css for this page -->
	<link href="assets/css/page-css/login.css" rel="stylesheet" type="text/css" media="all"/>	
	
</head>

<body>

  <div class="body"></div>
		<div class="grad"></div>
		<div class="header">
			<div>S<span>AMS</span></div>
		</div>
		<br>
		
		<div class="login toggleElement">
			<form action ="#" method = "post">
				<input type="text" placeholder="username" name="username" required><br>
				<input type="password" placeholder="password" name="password" required><br>
				<input class='firstBtn Btn' type="submit"  name='login' value="Login">
				<input class='secondaryBtn Btn loginRegisterToggle' type="button" value="Create new account">
			</form>
		</div>
		
		<div class="register toggleElement">
			<form action ="#" method = "post"  onsubmit="return check()">
				<input type="text" placeholder="username" name="username" required ><br>
				<input type="password" id='pass' placeholder="password" name="password" required onkeyup="checkPass();"><br>
				<input type="password" id='confirmpass' placeholder="confirm password" name="confirmPassword" required onkeyup="checkPass();"><br>
				<input class='firstBtn Btn' type="submit" name='register' value="Register">
				<input class='secondaryBtn Btn loginRegisterToggle' type="button" value="Login now">
			</form>
		</div>
		
	<!--script for this page -->	
	<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
	<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.1.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.0/sweetalert2.all.js"></script>
	<script src="assets/js/page-js/login.js"></script>	
	
	
	<!--php connection-->
	<?php 
		
		include("assets/php/mysql_connect.inc.php"); 	
		include("assets/php/user_function.php"); 
	?>

</body>
</html>
