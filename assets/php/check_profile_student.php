

<?php

	if($_SESSION['role']==1){
		if($_SESSION['profile']==0){

			$base = basename($_SERVER['REQUEST_URI']);


			if($base !='profile_student.php')
			{

				echo "
					<script>
						swal({
						  title: 'Please setup your profile first ',
						  type: 'info',
						  showCancelButton: false
						}).then((result) => {
						  location.href='profile_student.php';
						})
					</script>
				";
			}
		}
}
else
{
		echo "<script>
		swal('Please login first','','warning').then((result) => {
			location.href='..';
		});
		</script>";

}


 ?>
