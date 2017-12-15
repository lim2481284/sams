

<?php


	//Comment it to show the php error 
	error_reporting(0);


	$DB_HOST	="localhost";
	$DB_LOGIN	="root";
	$DB_PASSWORD="";
	$DB_NAME	="sams";


	$conn=mysqli_connect($DB_HOST,$DB_LOGIN,$DB_PASSWORD);

	if(!$conn)
	{
		die('Database connection error '.mysqli_error($conn));
	}

	$db_selected=mysqli_select_db($conn,$DB_NAME);
	if(!$db_selected)
	{
		die('DB error:' .$DB_NAME.')'.mysqli_error($conn));
	}
	
	session_start();
	
	
	
	//global variable
	if(isset($_SESSION['username']))
	{	
		$USERID= $_SESSION['userID'];
		$ROLE = $_SESSION['role'];		
		$USERNAME= $_SESSION['username'];		
		$PROFILE= $_SESSION['profile'];
	}
		
	if(isset($_SESSION['profile']))
	{
		if($_SESSION['profile']==0){

			$base = basename($_SERVER['REQUEST_URI']);
			if($base !='profile.php')
			{
				echo "					
					<script>
						swal({
						  title: 'Please setup your profile first ',						  
						  type: 'info',
						  showCancelButton: false
						}).then((result) => {
						  location.href='profile.php';
						})
					</script>
				";	
			}
		}
	}

	
 ?>
