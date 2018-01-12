

<?php



		//Edit profile sql
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {




			if(isset($_POST['update']))
			{
				$uemail = $_POST['email'];
				$ucontact = $_POST['contact'];
				$uaddress = $_POST['address'];
				$uabout =$_POST['about'];
				$fullName =$_POST['fullName'];
				$gender = $_POST['gender'];
				$name = $_POST['userName'];
        $cardID = $_POST['cardID'];

				$sql = "update users set profile=1, email = '$uemail',gender = '$gender', name= '$name',contact = '$ucontact',address = '$uaddress',cardID='$cardID', name = '$fullName' ,description  = '$uabout' where username = '$USERNAME' " ;
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
						  location.href='profile_student.php';
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
      $cardID = $row['cardID'];
			$userID = $row['userID'];

			echo "
				<script>
					$('.usernameField').attr('placeholder','$uname');
					$('.usernameTitle').html('$uname');
					$('.aboutTitle').html('$uabout');
					$('.email').val('$uemail');
					$('.contact').val('$ucontact');
					$('.gender').val('$ugender');
					$('.gender').change();
					$('.address').val('$uaddress');
					$('.about').val('$uabout');
					$('.fullName').val('$name');
					$('.userDescription').html('$uabout');
          $('.cardID').val('$cardID');


				</script>
			";


		}




 ?>
