$(document).ready(function(){

	//Side menu and top menu load function
	$('.menu').load('assets/php/menu_student.php',function(){
			$('.course').addClass('current');
	});

	//Find course function
  $('.findCourseBtn').on('click',function(){
    location.href='search_student.php';

  });


	$(document).on('click','.FormGroupBtn', function(){
		var count = $('.availableCheck:checked').length;
		var groupSize = $('.groupSize').val();

		if(count>groupSize){
			swal("Max group size is "+groupSize , '' ,'error');
		}
		else {
			$('#groupForm').submit();

		}

	});

});
