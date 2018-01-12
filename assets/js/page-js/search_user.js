$(document).ready(function(){

	//Side menu and top menu load function
	$('.menu').load('assets/php/menu_student.php',function(){
			$('.search').addClass('current');
	});


	$('.searchInput').on('click',function(){
		$(this).attr('placeholder','Subject code, lecturer name, subject name...');
			$(this).css('width','80%');
	})

});


$(document).on('click','.enrollBtn',function(){
   var id = $(this).val();
	 var searchKey = $('#searchKey').val();
  swal({
 	 title: 'Enrollment key',
 	 allowOutsideClick: false,
 	 showCancelButton: true,
 	 html:'<form id="myForm" action="" method="post" ><br><input id="swal-input-code" name="enrollmentKey" class="swal2-input"  value="" placeholder="Insert enrollment key here... "><input type="hidden" name="id" value="'+id+'"/><input type="hidden" name="searchKey" value="'+searchKey+'"/></form>',
 	 focusConfirm: false
  }).then(function (result) {
 		if (result.dismiss === 'cancel') {}
 		else{
			document.getElementById("myForm").submit();
		}
  }).catch(swal.noop)


});
