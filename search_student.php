
<link href="assets/css/page-css/search_user.css" rel="stylesheet">
<link href="assets/css/main_user.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">


<div class='menu'></div>

<div class='bodyContent'>
	<div class="form-group">
		<form action='' method='post'>
			<input type="text" name='searchInput' class="searchInput form-control username"  placeholder="Search here..." value="" >
			<button class='searchBtn' type="submit" name='searchCourse'><i class="fa fa-search"></i></button>
		</form>
	</div>

	<div class='searchResult'>

	</div>
</div>

<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.0/sweetalert2.all.js"></script>
<script src="assets/js/page-js/search_user.js" type="text/javascript"></script>
<!--php connection-->
<?php
include("assets/php/mysql_connect.inc.php");
include("assets/php/check_profile_student.php");
include("assets/php/student/search_function.php");
?>
