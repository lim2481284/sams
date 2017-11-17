
$(document).ready(function(){
		
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

			
			document.getElementById("myForm").submit();
													
		}).catch(swal.noop)
	});
	
});