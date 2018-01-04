
<link href="assets/css/page-css/profile_user.css" rel="stylesheet">
<link href="assets/css/main_user.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">


<div class='menu'></div>

<div class='bodyContent'>

</div>

<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script>
$(document).ready(function(){

	//Side menu and top menu load function
	$('.menu').load('assets/php/menu_student.php',function(){
			$('.home').addClass('current');
	});

});
</script>
