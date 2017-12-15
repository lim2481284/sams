function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#uploadedImage')
				.attr('src', e.target.result)
				.width(200)
				.height(200);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

$(document).ready(function(){
	$(document).on('change','.profileFileUpload',function(){		
		$("#pictureForm").submit();
	});
	
	
	$('.changePasswordBtn').click(function(){
	  
		swal({
		  title: 'Change password',			  
		  allowOutsideClick: false,
		  showCancelButton: true,
		  html:'<form id="myForm" action="#" method="post" ><br><label class="swal-label">Old password </label><input id="swal-input-code" name="oldPass" class="swal2-input"  value="">' +
		  '<label class="swal-label">New password </label><input name="newPass" id="swal-input-name" class="swal2-input" value=""><input type="hidden" name="changePass"/></form>',			  
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
				  document.getElementById("myForm").submit();																
			
		}).catch(swal.noop)
	});
	
	
	
});

