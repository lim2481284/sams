<div class="sidebar" data-color="purple" data-image="assets/img/sidebar-5.jpg">

	<div class="sidebar-wrapper">
		<div class="logo">
			<a href="http://www.creative-tim.com" class="simple-text">
				SAMS U10
			</a>
			<img src='assets/img/profile.png'/>
		</div>

		<ul class="nav">
			<li class="dashboard">
				<a href="dashboard.php">
					<i class="pe-7s-graph"></i>
					<p>Dashboard</p>
				</a>
			</li>
			<li  class="profile">
				<a href="profile.php">
					<i class="pe-7s-user"></i>
					<p>User Profile</p>
				</a>
			</li>
			<li  class="courseList studentSection">
				<a href="courseList.php">
					<i class="pe-7s-note2"></i>
					<p>Course List</p>
				</a>
			</li>
			<li  class="myCourse">
				<a href="myCourse.php">
					<i class="pe-7s-news-paper"></i>
					<p>My Course</p>
				</a>
			</li>
			<li  class="settings">
				<a href="settings.php">
					<i class="pe-7s-science"></i>
					<p>Settings</p>
				</a>
			</li>
			<li  class="notifications">
				<a href="notifications.php">
					<i class="pe-7s-bell"></i>
					<p>Notifications</p>
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
	if($userRole == 1)
	{
		echo "
		<script>
			$('.studentSection').show();
			$('.lecturerSection').hide();
		</script>
		";
	}
	else 
	{
		echo "
		<script>
			$('.studentSection').hide();
			$('.lecturerSection').show();
		</script>
		";
	}

?>