function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.readAsDataURL(input.files[0]);
	}
}




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


	//Display submit box
	$(document).on('click','.submitBtn',function(){
		$('.uploadSection').addClass('uploadCover');
		var assID = $(this).parent().find('.assID').val();
		$('.assIDForUpload').val(assID);
	});

	//Hide submit box
	$(document).on('click','.uploadBackBtn',function(){
			$('.uploadSection').removeClass('uploadCover');
	});

	//submit file function
	$(document).on('click','.submitFileBtn',function(){
			$('#fileForm').submit();
	});


	//when user select "select" action
	$(document).on('change','.selectAction',function(){
			var assID = $(this).parent().find('.assID').val();
			var action = $(this).val();


			//If action is check group
			if(action =='checkGroup'){
				//navigate to check group page
				location.href='?formGroup='+assID;
			}

			//If action is submit
			if(action =='submit'){
					$('.uploadSection').addClass('uploadCover');
					var assID = $(this).parent().find('.assID').val();
					$('.assIDForUpload').val(assID);
			}

			//If action is kanban
			if(action =='kanban'){
				location.href='kanban.php';
			}

	});

});
