

<?php
	

		
		//Edit profile sql 	
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {	
			
			if(isset($_POST['update']))
			{	
				$uemail = $_POST['email'];
				$ucontact = $_POST['contact'];
				$uaddress = $_POST['address'];
				$uabout =$_POST['about'];

				
				$sql = "update users set email = '$uemail',contact = '$ucontact',address = '$uaddress',description  = '$uabout' where username = '$USERNAME' " ;
				
				
				if(mysqli_query($conn,$sql))
				{
					echo"
					<script> 
						alert('Edit success');
						header('Refresh:0');
					</script>
					";
					
				}
				else 
				{
					 echo("Error description: " . mysqli_error($conn));
				}
			}	
				
		}

		//Grab profile data sql 
		$sql = "select * from users where username = '$USERNAME' and pass = '$PASS' ";
		$result = mysqli_query($conn,$sql);			
		if(mysqli_num_rows($result)==1)
		{
			$row = mysqli_fetch_assoc($result);
			
			$uname = $row['username'];
			$uemail = $row['email'];
			$ucontact = $row['contact'];
			$uaddress = $row['address'];
			$ugender = $row['gender'];
			$uabout = $row['description'];			
			
			
			echo "
				<script>
					$('.username').val('$uname');
					$('.usernameTitle').html('$uname');
					$('.aboutTitle').html('$uabout');
					$('.email').val('$uemail');
					$('.contact').val('$ucontact');
					$('.gender').val('$ugender');
					$('.address').val('$uaddress');
					$('.about').val('$uabout');
				
				</script>			
			";
		
		}
		else 
		{
			//Something wrong 
			echo "<script> console.log('Something wrong');</script>";
			
		}
				
		

 ?>
