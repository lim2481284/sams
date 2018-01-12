<div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

	<div class="sidebar-wrapper">
		<div class="logo">
			<a href="http://www.creative-tim.com" class="simple-text">
				SAMS U10
			</a>
			<img class='menuPicture' src=''/>
		</div>

		<ul class="nav">
			<li class="dashboard">
				<a href="dashboard_lecturer.php">
					<i class="pe-7s-graph"></i>
					<p>Dashboard</p>
				</a>
			</li>
			<li  class="profile">
				<a href="profile_lecturer.php">
					<i class="pe-7s-user"></i>
					<p>User Profile</p>
				</a>
			</li>
			<li  class="myCourse">
				<a href="course_lecturer.php">
					<i class="pe-7s-news-paper"></i>
					<p>My Course</p>
				</a>
			</li>
		</ul>
	</div>
</div>


<!-- Dynamic script to handle menu active color -->
<script>
$(function() {
	var url = window.location.pathname.split("/").pop();
	var path = url.split(".");
	var path_name = path[0];
	if(path_name=="")
	{
		$('.dashboard').addClass("active");
	}
	else
	{

		$('.'+path_name).addClass("active");
	}
});
</script>

<!-- change menu sturcutre based on role -->
<?php
	session_start();
	$userRole = $_SESSION['role'];
	$img_url = $_SESSION['img_url'];

	// change menu picture
	echo "
		<script>
			$('.menuPicture').attr('src','assets/img/profile/$img_url'+'.png');
		</script>
	";


?>
