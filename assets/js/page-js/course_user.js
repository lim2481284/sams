$(document).ready(function(){

	//Side menu and top menu load function
	$('.menu').load('assets/php/menu_student.php',function(){
			$('.course').addClass('current');
	});

  $('.findCourseBtn').on('click',function(){
    location.href='search_student.php';

  });
});
