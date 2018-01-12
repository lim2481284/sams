

<?php


if($_SESSION['role']==2){
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
						  location.href='profile_lecturer.php';
						})
					</script>
				";
			}
		}

	}
	else {
		echo "
			<script>
				swal({
					title: 'Please login first ',
					type: 'warning',
					showCancelButton: false
				}).then((result) => {
					location.href='..';
				})
			</script>
		";

	}


 ?>
