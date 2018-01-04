

<?php



		//Edit profile sql
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

			if(isset($_POST['changePass']))
			{
				$oldPass = $_POST['oldPass'];
				$newPass = $_POST['newPass'];
				$sql = "select * from users where username = '$USERNAME' and password = '$oldPass'" ;
				$result = mysqli_query($conn,$sql);
				if(mysqli_num_rows($result)==1)
				{
					$sql = "update users set password= '$newPass' where username = '$USERNAME' " ;
					if(mysqli_query($conn,$sql))
					{
						echo"
						<script>
							swal({
							  title: 'Password changed',
							  type: 'success',
							  showCancelButton: false
							}).then((result) => {
							  location.href='profile_lecturer.php';
							})
						</script>
						";
					}
				}
				else
				{
					echo"
						<script>
							swal('Wrong password!','','error');
						</script>
					";
				}



			}

			if(isset($_POST['picture']))
			{
				$name=$_POST['pictureName'];
				$target_dir = "assets/img/profile/";
				$target_file = $target_dir . $name . ".png";
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				 if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

					$sql = "update users set img_url= '$name' where username = '$USERNAME' " ;
					if(mysqli_query($conn,$sql))
					{
						 $_SESSION['img_url'] = $name;
						echo"
						<script>
							swal({
							  title: 'Profile picture uploaded',
							  type: 'success',
							  showCancelButton: false
							}).then((result) => {
							  location.href='profile_lecturer.php';
							})
						</script>
						";
					}
				} else {
					echo "Sorry, there was an error uploading your file.";
				}


			}

			if(isset($_POST['update']))
			{
				$uemail = $_POST['email'];
				$ucontact = $_POST['contact'];
				$uaddress = $_POST['address'];
				$uabout =$_POST['about'];
				$gender = $_POST['gender'];
				$name = $_POST['userName'];


				$sql = "update users set profile=1, email = '$uemail',gender = '$gender', name= '$name',contact = '$ucontact',address = '$uaddress',description  = '$uabout' where username = '$USERNAME' " ;
				$_SESSION['profile'] = 1;

				if(mysqli_query($conn,$sql))
				{
					echo"
					<script>
						swal({
						  title: 'Edit success',
						  type: 'success',
						  showCancelButton: false
						}).then((result) => {
						  location.href='profile_lecturer.php';
						})
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
		$sql = "select * from users where username = '$USERNAME'";
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
			$name = $row['name'];
			$userID = $row['userID'];
			$img_url = $row['img_url'].".png";

			echo "
				<script>
					$('.username').val('$uname');
					$('.usernameTitle').html('$uname');
					$('.aboutTitle').html('$uabout');
					$('.email').val('$uemail');
					$('.contact').val('$ucontact');
					$('.gender').val('$ugender');
					$('.gender').change();
					$('.address').val('$uaddress');
					$('.about').val('$uabout');
					$('.userName').val('$name');
					$('.userDescription').html('$uabout');
					$('.pictureName').val('img_$userID');
					$('#uploadedImage').attr('src','assets/img/profile/$img_url');


				</script>
			";


		}
		else
		{
			//Something wrong
			echo "<script> console.log('Something wrong');</script>";

		}



 ?>
