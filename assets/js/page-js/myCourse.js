function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.readAsDataURL(input.files[0]);
	}
}		


$(document).ready(function(){
		
		
	$(document).on('change','.materialFileUpload',function(){		
		$("#fileForm").submit();
	});
	
		
	//On click assignment and material button 
	//Change the table and hightlight the menu button 
	$('.materialBtn').click(function(){
		$(this).attr('class','materialBtn menuActive courseMenuList');
		$('.assignmentBtn').attr('class','assignmentBtn courseMenuList');
		$('.assignmentSection').hide();
		$('.materialSection').show();
		
	});
	$('.assignmentBtn').click(function(){
		$(this).attr('class','assignmentBtn menuActive courseMenuList');
		$('.materialBtn').attr('class','materialBtn courseMenuList');
		$('.assignmentSection').show();
		$('.materialSection').hide();
		
	});	
		
	//back button 
	$('.backBtn').click(function(){
		
		window.location.href = "myCourse.php";
	});
	
	
		
	//Edit course button function 
	$('.editCourse').click(function(){
		var code = $('.infoCourseCode').val();
		var name = $('.infoCourseName').html();
		var description = $('.infoCourseDescription').html();
		var key = $('.courseKey').val();
		var courseID = $('.courseID').val();
		
		
		swal({
		  title: 'Create Folder',			  
		  allowOutsideClick: false,
		  showCancelButton: true,
		  html:'<form id="myForm" action="#" method="post" ><br><label class="swal-label">Subject code  </label><input id="swal-input-code" name="code" class="swal2-input"  value="'+code+'"><input type="hidden" name="editCourse" value="'+courseID+'"/>' +
		  '<label class="swal-label">Subject name </label><input name="name" id="swal-input-name" class="swal2-input" value="'+name+'"><label class="swal-label">Enrollment key </label><input name="key" id="swal-input-key" class="swal2-input" value="'+key+'"><label class="swal-label">Description </label><input name="description" id="swal-input-description" class="swal2-input" value="'+description+'"></form>',			  
		  focusConfirm: false,
		  preConfirm: function () {
			return new Promise(function (resolve,reject) {	
				if(!$('#swal-input-name').val())
				{							
					reject('Please fill in all the info');
				}					  
				else {
					resolve([
					  $('#swal-input-name').val(),
					  $('#swal-input-code').val(),
					  $('#swal-input-key').val(),
					  $('#swal-input-description').val()
					])					
				}
			})
		  }
		}).then(function (result) {						
			  if (result.dismiss === 'cancel') {}
			  else 
			  {
				document.getElementById("myForm").submit();
			  }
													
		}).catch(swal.noop)
	});

	
		
	//Create course button function 
	$('.createCourse').click(function(){
	  
		swal({
		  title: 'Create Folder',			  
		  allowOutsideClick: false,
		  showCancelButton: true,
		  html:'<form id="myForm" action="#" method="post" ><br><label class="swal-label">Subject code  </label><input id="swal-input-code" name="code" class="swal2-input"  value=""><input type="hidden" name="createCourse"/>' +
		  '<label class="swal-label">Subject name </label><input name="name" id="swal-input-name" class="swal2-input" value=""><label class="swal-label">Enrollment key </label><input name="key" id="swal-input-key" class="swal2-input" value=""><label class="swal-label">Description </label><input name="description" id="swal-input-description" class="swal2-input" value=""></form>',			  
		  focusConfirm: false,
		  preConfirm: function () {
			return new Promise(function (resolve,reject) {	
				if(!$('#swal-input-name').val())
				{							
					reject('Please fill in all the info');
				}					  
				else {
					resolve([
					  $('#swal-input-name').val(),
					  $('#swal-input-code').val(),
					  $('#swal-input-key').val(),
					  $('#swal-input-description').val()
					])					
				}
			})
		  }
		}).then(function (result) {						
			  if (result.dismiss === 'cancel') {}
			  else 
			  {
				document.getElementById("myForm").submit();
			  }
													
		}).catch(swal.noop)
	});
	
	var courseID = getUrlParameter('courseID');
	if(courseID)
	{
		$('.displayCourseSection').show();
		
		
	}
	else 
	{
		$('.createCourseSection').show();
	}	
		
});


var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};