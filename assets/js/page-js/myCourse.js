function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		reader.readAsDataURL(input.files[0]);
	}
}


$(document).ready(function(){
   $( "#datepicker" ).datepicker();
	//Edit assignment button function
	$('.editAssignmentBtn').click(function(){
		var title = $(this).parent().parent().find('.assignmentTitle').html();
		var assignmentDescription = $(this).parent().parent().find('.assignmentDescription').html();
		var assignmentDeadline = $(this).closest('tr').find('.assignmentDeadline').html();

		var assignmentID = $('.assignmentID').val();


		swal({
		  title: 'Create Folder',
		  allowOutsideClick: false,
		  showCancelButton: true,
		   html:`
		  <form id="myForm" action="#" method="post" >
			<br>
			<label class="swal-label">Assignment name  </label>
			<input id="swal-input-code" name="name" class="swal2-input"  value="`+title+`">
			<input type="hidden" name="editAssignment" value=""/>
			<label class="swal-label">Assignment description </label>
			<input type="hidden" name="courseID" value="`+courseID+`"/>
			<input type="hidden" name="assignmentID" value="`+assignmentID+`"/>
			<input name="description" id="swal-input-name" class="swal2-input" value="`+assignmentDescription+`">
			<label class="swal-label">Deadline </label>
			<input name="deadline" id="deadline" type='text' class="swal2-input datepicker" value="`+assignmentDeadline+`">
		  </form>

			`,
		  focusConfirm: false
		}).then(function (result) {
			  if (result.dismiss === 'cancel') {}
			  else
			  {
				document.getElementById("myForm").submit();
			  }

		}).catch(swal.noop)
	});


	//Add assignemnt button function
	$('.addAssignment').click(function(){


		var courseID = $('.courseID').val();
		swal({
		  title: 'Create Assignment',
		  allowOutsideClick: false,
		  showCancelButton: true,
		  html:`
		  <form id="myForm" action="#" method="post" >
			<br>
			<label class="swal-label">Assignment name  </label>
			<input id="swal-input-code" name="name" class="swal2-input"  value="">
			<input type="hidden" name="createAssignment" value=""/>
			<label class="swal-label">Assignment description </label>
			<input type="hidden" name="courseID" value="`+courseID+`"/>
			<input name="description" id="swal-input-name" class="swal2-input" value="">
			<label class="swal-label">Assigment type </label>
			<select class="swal2-input assType" name='assType'>
				<option value='0'>Individual</option>
				<option value='1'>Group</option>
			</select>
			<label class="swal-label">Group size </label>
			<input name="score" id="swal-input-key" type='text' class="swal2-input"  placeholder='Group size (if any)'>
			<label class="swal-label">Deadline </label>
			<input name="deadline" id="swal-input-key" type='date' class="swal2-input" value="">
			<label class="swal-label">Total mark </label>
			<input name="score" id="swal-input-key" type='text' class="swal2-input" value="">
		  </form>`,
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



	$(document).on('change','.materialFileUpload',function(){
		$("#fileForm").submit();
	});


	//On click assignment and material button
	//Change the table and hightlight the menu button
	$('.materialBtn').click(function(){
		$(this).attr('class','materialBtn menuActive courseMenuList');
		$('.assignmentBtn').attr('class','assignmentBtn courseMenuList');
		$('.assignmentSection').hide();
		$('.studentSection').hide();
		$('.materialSection').show();

	});
	$('.assignmentBtn').click(function(){
		$(this).attr('class','assignmentBtn menuActive courseMenuList');
		$('.materialBtn').attr('class','materialBtn courseMenuList');
		$('.assignmentSection').show();
		$('.materialSection').hide();
		$('.studentSection').hide();

	});
	$('.studentBtn').click(function(){
		$(this).attr('class','studentBtn menuActive courseMenuList');
		$('.materialBtn').attr('class','materialBtn courseMenuList');
			$('.assignmentBtn').attr('class','assignmentBtn courseMenuList');
		$('.studentSection').show();
		$('.materialSection').hide();
		$('.assignmentSection').hide();

	});
	//back button
	$('.backBtn').click(function(){
		window.location.href = "course_lecturer.php";
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
