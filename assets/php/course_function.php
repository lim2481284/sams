

<?php
	

		
		//Edit profile sql 	
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {	
			
			if(isset($_POST['createCourse']))
			{	
				
				$code = $_POST['code'];
				$name = $_POST['name'];
				$key = $_POST['key'];
				$description = $_POST['description'];
				
			
				$sql="insert into course (`courseCode`,`name`,`description`,`courseKey`) values ('$code', '$name', '$description', '$key')";		
				if(mysqli_query($conn,$sql))
				{
					echo"
					<script> 
						swal('Course created','','success');
						
					</script>";
					
				}else 
				{
					echo"<script> swal('Course Code already exists','','error');
					</script>";
				}

				
			}	
				
		}

		//Grab profile data sql 
		$sql = "select * from course";
		$result = mysqli_query($conn,$sql);			
		while($row = mysqli_fetch_assoc($result))
		{
		
			$code = $row['courseCode'];
			$name = $row['name'];
			$description = $row['description'];
			$key = $row['courseKey'];
			
			echo "
				<script>
				
					var list = `
						<div class=\"font-icon-list col-lg-3 col-md-3 col-sm-4 col-xs-6 col-xs-6\">
							<div class=\"font-icon-detail\"><i class=\"pe-7s-note2\"></i>
								 <input type=\"text\" value=\"$code\">
								 <label class='courseText'>$name</label>
							</div>
						  </div>
							  
					`;				
					$('.courseListSection').append(list);
				</script>									
			";

																				
			
		}
		
		

 ?>
