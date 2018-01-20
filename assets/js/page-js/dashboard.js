$(document).ready(function(){

	// On change course list
	$(document).on('change','.courseList',function(){
		var courseID = $(this).val();
		$('.table').hide();
		$('.table'+courseID).fadeIn(300);
	});


});
