

<?php
	
	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {	
						

	
		if(isset($_POST['login']))
		{	

			$username  = $_POST['username'];							
			$pass  = $_POST['password'];		
			
			$sql = "select * from users where username = '$username' and pass = '$pass' ";
			$result = mysqli_query($conn,$sql);			
			if(mysqli_num_rows($result)==1)
			{
				$row = mysqli_fetch_assoc($result);
				
				$_SESSION['userId'] = $row['id'];				
				$_SESSION['role'] = $row['roleId'];
				$_SESSION['username'] = $username;				
				$_SESSION['pass'] = $pass;
													
				
				echo '					
					<script>
						alert("Login success");
						location.href="dashboard.php";
					</script>
				';		
			}
			else 
			{
				echo '<script>alert("Wrong password or username ");				
				</script>';
			}
						
			
		}		
	}



 ?>
