$(document).ready(function(){

	//Side menu and top menu load function
	$('.menu').load('assets/php/menu_student.php',function(){
			$('.home').addClass('current');

	});


	$('.courseCode').on('click',function(){
		var courseID = $(this).attr('value');
		location.href='course_student.php?courseID='+courseID;
	});
});
