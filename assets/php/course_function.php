

<?php


		//Edit profile sql
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {


			//Edit  assignment function
			if(isset($_POST['editAssignment']))
			{

				$courseID = $_POST['courseID'];
				$name = $_POST['name'];
				$mark = $_POST['mark'];
				$description = $_POST['description'];
				$assignmentID = $_POST['assignmentID'];
				$deadline = $_POST['deadline'];

				$sql = "update assignment set score='$mark', assignmentName= '$name',assignmentDescription= '$description',endDate= '$deadline' where assignmentID= '$assignmentID' ";

				if(mysqli_query($conn,$sql))
				{
					echo"
					<script>
						swal('Assignment updated','','success');
					</script>";

				}else
				{
					echo"<script> swal('Something wrong','','error');
					</script>";
				}


			}

			//Create assignment function
			if(isset($_POST['createAssignment']))
			{
				$courseID = $_POST['courseID'];
				$name = $_POST['name'];
				$assType = $_POST['assType'];
				$score = $_POST['score'];
				$description = $_POST['description'];
				$groupSize = $_POST['groupSize'];
				$deadline = $_POST['deadline'];
				$sql="insert into assignment (`courseID`,`group_size`,`assignmentType`,`assignmentName`,`assignmentDescription`,`endDate`,`score`) values ('$courseID',$groupSize,'$assType', '$name', '$description', '$deadline','$score')";
				if(mysqli_query($conn,$sql)){

					echo"
						<script>
							swal({
							  title: 'Assignment created ',
							  type: 'success',
							  showCancelButton: false
							}).then((result) => {

							})
						</script>
					";

				}
			}

			//Delete assignemnt function
			if(isset($_POST['deleteAssignment']))
			{
				$id = $_POST['assignmentID'];

				$sql="delete from assignment where assignmentID ='$id'";
				if(mysqli_query($conn,$sql)){

					echo"
						<script>
							swal({
							  title: 'Assignment deleted',
							  type: 'success',
							  showCancelButton: false
							}).then((result) => {

							})
						</script>
					";

				}
			}

			//Delete material function
			if(isset($_POST['deleteMaterial']))
			{
				$link = $_POST['materialLink'];
				$course = $_POST['courseID'];
				$sql="delete from course_material where material_link ='$link' and courseID='$course'";
				if(mysqli_query($conn,$sql)){

					echo"
						<script>
							swal({
							  title: 'Material deleted',
							  type: 'success',
							  showCancelButton: false
							}).then((result) => {

							})
						</script>
					";

				}
			}

			//Upload file function
			if(isset($_POST['file']))
			{
				$courseID = $_POST['courseID'];
				$name= basename($_FILES["fileToUpload"]["name"]);
				$target_dir = "assets/img/material/";
				$target_file = $target_dir . $name;
				$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
				 if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

					$sql="insert into course_material (`courseID`,`material_link`) values ('$courseID', '$name')";
					if(mysqli_query($conn,$sql))
					{
						echo"
						<script>
							swal({
							  title: 'Assignment material uploaded',
							  type: 'success',
							  showCancelButton: false
							}).then((result) => {

							})
						</script>
						";
					}
				} else {
					echo "Sorry, there was an error uploading your file.";
				}


			}

			//Create course function
			if(isset($_POST['createCourse']))
			{

				$code = $_POST['code'];
				$name = $_POST['name'];
				$key = $_POST['key'];
				$description = $_POST['description'];
				$userID = $_SESSION['userID'];
				$userName = $_SESSION['userName'];


				$sql="insert into course (`courseCode`,`courseName`,`courseDescription`,`courseKey`,`userID`,`lecturer_name`) values ('$code', '$name', '$description', '$key','$userID','$userName')";
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


			//Edit course function
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


		//DIsplay course content function based on paremeter
		if(isset($_GET['courseID']))
		{


			//Grab profile data
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

			//Grab mateiral data
			$sql = "select * from course_material where courseID = $courseID";
			$result = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_assoc($result))
			{

				$link = $row['material_link'];
				$courseID = $row['courseID'];

				echo "
					<script>
						var list = `
							<tr>
								<td class='t_1'>
									<label class='courseLabelTitle'>$link</label>
								</td>
								<td class='t_2'>
								</td>
								<td class='t_3'>
									<a download href='assets/img/material/$link'> <button class='customBtn'> Download  </button></a>
									<form action='#' method='post'>
										<button class='customBtn deleteMaterialBtn' name='deleteMaterial' >Delete    </button>
										<input type='hidden' name='materialLink' value='$link'/>
										<input type='hidden' name='courseID' value='$courseID'/>
									</form>
								</td>
							</tr>

						`;
						$('.courseMaterialList').append(list);
					</script>
				";



			}



			//Grab assignment data
			$sql = "select * from assignment where courseID = $courseID order by endDate DESC";
			$result = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_assoc($result))
			{

				$name = $row['assignmentName'];
				$description = $row['assignmentDescription'];
				$deadline = $row['endDate'];
				$mark = $row['score'];
				$assignmentID = $row['assignmentID'];
				$courseID = $row['courseID'];
				$type = $row['assignmentType'];
				$size = $row['group_size'];
				$today = date("Y-m-d");   

				if($type==1)
				{
					$type ="Group ($size)";
					$option ="
						<select class='form-control actionList'>
							<option  selected>Choose action... </option>
							<option value='deleteAssBtn'> Delete assignment </option>
							<option value='editAssBtn'> Edit assignment </option>
							<option value='verifySubBtn'> Verify submission </option>
							<option value='verifyGroupBtn'> Verify group </option>
						</select>
					";
				}
				else
				{
					$type ='Individual';
					$option ="
						<select class='form-control actionList'>
							<option  selected>Choose action... </option>
							<option value='deleteAssBtn'> Delete assignment </option>
							<option value='editAssBtn'> Edit assignment </option>
							<option value='verifySubBtn'> Verify submission </option>
						</select>
					";
				}

				if($deadline < $today){
						$option = "
						<select class='form-control actionList' disabled>
							<option  selected>Closed </option>
						</select>
						";
				}

				echo "
					<script>

						var list = `
							<tr>
								<td class='t_1'>
									<p  class='assignmentTitle' >$name</p>
									<label class='assignmentDescription'>$description</label>

								</td>
								<td class='t_2 assignmentDeadline'>$deadline</td>
								<td class='t_2 assignmentType'>$type</td>
								<td class='t_2 assignmentMark'>$mark</td>
								<td class='t_3'>
									<form class='initialForm' action ='#' method='post'>
										<input type='hidden' value='$assignmentID' class='assignmentID' name='assignmentID'/>
										$option
									</form>

								</td>
							</tr>
						`;
						$('.courseInfoAssignmentList').append(list);
					</script>
				";



			}



			//Grab student list
			$sql = "select * from user_course where courseID = $courseID";
			$result = mysqli_query($conn,$sql);
			while($row = mysqli_fetch_assoc($result))
			{
				$studentID = $row['userID'];
				$sql_get_student =  "select * from users where userID='$studentID'";
				$result_get_student = mysqli_query($conn,$sql_get_student);
				$list_get_student = mysqli_fetch_assoc($result_get_student);
				$cardID = $list_get_student['cardID'];
				$studentName = $list_get_student['name'];
				$studentEmail = $list_get_student['email'];
				$studentContact = $list_get_student['contact'];
				$studentAddress= $list_get_student['address'];

				echo "
					<script>

						var list = `
								<tr>
									<td>$cardID</td>
									<td>$studentName</td>
									<td>$studentEmail</td>
									<td>$studentContact</td>
								</tr>
						`;
						$('.studentTableContent').append(list);
					</script>
				";



			}
		}
		else
		{

			//Grab profile data sql
			$sql = "select * from course where userID ='$USERID'";
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
