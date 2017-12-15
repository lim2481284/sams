

<?php
	

		
		//Edit profile sql 	
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {	
			
			if(isset($_POST['createCourse']))
			{	
				
				$code = $_POST['code'];
				$name = $_POST['name'];
				$key = $_POST['key'];
				$description = $_POST['description'];
				
			
				$sql="insert into course (`courseCode`,`courseName`,`courseDescription`,`courseKey`) values ('$code', '$name', '$description', '$key')";		
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
			
			if(isset($_POST['editCourse']))
			{	
				
				$code = $_POST['code'];
				$id = $_POST['editCourse'];
				$name = $_POST['name'];
				$key = $_POST['key'];
				$description = $_POST['description'];
				
				$sql = "update course set courseCode= '$code',courseName= '$name',courseDescription= '$description',courseKey= '$key' where courseID= '$id' ";
					
				if(mysqli_query($conn,$sql))
				{
					echo"
					<script> 
						swal('Course updated','','success');
						
					</script>";
					
				}else 
				{
					echo"<script> swal('Something wrong','','error');
					</script>";
				}

				
			}	
				
		}

		if(isset($_GET['courseID']))
		{
				
			
			//Grab profile data sql 
			$courseID = $_GET['courseID'];
			$sql = "select * from course where courseID = $courseID";
			$result = mysqli_query($conn,$sql);			
			while($row = mysqli_fetch_assoc($result))
			{
			
				$code = $row['courseCode'];
				$name = $row['courseName'];
				$description = $row['courseDescription'];
				$key = $row['courseKey'];
				$courseID = $row['courseID'];
				$key = $row['courseKey'];
				
				echo "
					<script>
						$('.infoCourseCode').val('$code');
						$('.infoCourseName').html('$name');
						$('.infoCourseDescription').html('$description');	
						$('.courseID').val('$courseID');
						$('.courseKey').val('$key');
					</script>									
				";
				
																					
				
			}
		}
		else 
		{
			
			//Grab profile data sql 
			$sql = "select * from course";
			$result = mysqli_query($conn,$sql);			
			while($row = mysqli_fetch_assoc($result))
			{
			
				$code = $row['courseCode'];
				$name = $row['courseName'];
				$description = $row['courseDescription'];
				$key = $row['courseKey'];
				$courseID = $row['courseID'];
				
				echo "
					<script>
					
						var list = `
							<a href='?courseID=$courseID'>
								<div class=\"font-icon-list col-lg-3 col-md-3 col-sm-4 col-xs-6 col-xs-6\">
									<div class=\"font-icon-detail\"><i class=\"pe-7s-note2\"></i>
										 <input type=\"text\" value=\"$code\">
										 <label class='courseText'>$name</label>
									</div>
								</div>
							</a>	  
						`;				
						$('.courseListSection').append(list);
					</script>									
				";
				
																					
				
			}			
		}
		

 ?>
