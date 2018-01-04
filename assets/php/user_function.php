

<?php

	if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {



		if(isset($_POST['login']))
		{

			$username  = $_POST['username'];
			$pass  = $_POST['password'];

			$sql = "select * from users where username = '$username' and password = '$pass' ";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)==1)
			{
				$row = mysqli_fetch_assoc($result);
				$_SESSION['userName'] = $row['name'];
				$_SESSION['userID'] = $row['userID'];
				$_SESSION['role'] = $row['roleId'];
				$_SESSION['username'] = $username;
				$_SESSION['profile'] = $row['profile'];
				$_SESSION['img_url'] = $row['img_url'];

				echo "
					<script>
						swal({
						  title: 'Login success',
						  type: 'success',
						  showCancelButton: false
						}).then((result) => {";

							if($_SESSION['role']==1)
						  	echo "location.href='dashboard_student.php';";
							else
								echo "location.href='dashboard_lecturer.php';";
						echo"})
					</script>
				";
			}
			else
			{
				echo '
				<script>
					swal("Username or password incorrect","","error");
				</script>
				';
			}


		}

		if(isset($_POST['register']))
		{

			$username  = $_POST['username'];
			$pass  = $_POST['password'];
			$sql = "insert into users (`username`,`password`) values ( '$username','$pass' )";
			if(mysqli_query($conn,$sql)){

				echo '
					<script>
						swal("Register success","","success");
					</script>
				';
			}
			else {
				echo '
					<script>
						swal("Username already exist","","error");
					</script>
				';
			}



		}
	}



 ?>
