

<?php


		//If verify submission is called
		if(isset($_GET['verifySubmission']))
		{
				//Check assignment type
				$assID = $_GET['verifySubmission'];
				$sql= "select * from assignment where assignmentID =$assID";
				$result = mysqli_query($conn,$sql);
				$list_ass = mysqli_fetch_assoc($result);
				$assType = $list_ass['assignmentType'];

				//Get all the submission
				$sql = "select * from assignment_submission where assignmentID = $assID";
				$result = mysqli_query($conn, $sql);
				$count =1;
				while($list_submission = mysqli_fetch_assoc($result)){

						$userID = $list_submission['userID'];
						$submission = $list_submission['submission_link'];
						$score = $list_submission['score'];
						$date = $list_submission['created_at'];
						if($assType==0){	//if assignment is individual

							//Get user name
							$sql_user  ="select * from users where userID = $userID";
							$result_user = mysqli_query($conn,$sql_user);
							$list_user = mysqli_fetch_assoc($result_user);
							$userName = $list_user['name'];
							$cardID = $list_user['cardID'];
							$NAME = $cardID." - ".$userName;

						}
						else {	//if assignment is group

							//Get group name
							$sql_user  ="select * from assignment_group where groupLeaderID = $userID";
							$result_user = mysqli_query($conn,$sql_user);
							$list_user = mysqli_fetch_assoc($result_user);
							$groupName  = $list_user['groupName'];
							$NAME = "Group - ".$groupName;

						}

						echo "
						<script>
							var tableHTML = `

							<tr>

								<td>$count</td>
								<td>$NAME</td>
								<td><a download href='assets/img/submission/$submission'>  $submission  </a></td>
								<td>$date</td>
								<td>
									<form class='Form$count' action='' method='post'>
										<input type='hidden' name='assID' value='$assID'/>
										<input type='hidden' name='userID' value='$userID'/>
										<input type='number' value='$score' class='markField' name='mark' />
									</form>
								</td>
								<td><button class='btn btn-info updateMarkBtn' value='$count'>Update mark </button></td>

							</tr>

							`;
							$('.submissionTable').append(tableHTML);
						</script>
						";

						$count++;
				}

		}

		//If verify group is called
		if(isset($_GET['verifyGroup']))
		{

			//Get all group from this assignment
			$assID = $_GET['verifyGroup'];
			$sql_group = "select * from assignment_group where assignmentID = $assID";
			$result_group = mysqli_query($conn,$sql_group);
			while($list_group= mysqli_fetch_assoc($result_group))
			{

				//Get this group detail
				$groupID = $list_group['groupID'];
				$groupName = $list_group['groupName'];
				$groupLeader = $list_group['groupLeader'];
				$groupStatus = $list_group['status'];
				$groupLeadID = $list_group['groupLeaderID'];
				$sql ="select * from users where userID = $groupLeadID";
				$result = mysqli_query($conn, $sql);
				$list = mysqli_fetch_assoc($result);
				$name = $list['name'];
				$cardID = $list['cardID'];

				//Generate group html
				echo "
					<script>
						var groupHTML = `
								<div class='groupSection'>
										<div class='groupName'>
												$groupName
										</div>
										<div class='groupList'>
												<div class='groupLead'>$cardID - $groupLeader </div>
										</div>
						`;

					</script>
				";

				//Get all member from this group
				$sql_member = "select * from group_member where groupID = $groupID and userID != $groupLeadID ";
				$result_member = mysqli_query($conn,$sql_member);
				while($list_member= mysqli_fetch_assoc($result_member))
				{

					$memberID = $list_member['userID'];
					$sql ="select * from users where userID = $memberID";
					$result = mysqli_query($conn, $sql);
					$list = mysqli_fetch_assoc($result);
					$name = $list['name'];
					$cardID = $list['cardID'];

					//Generate member html
					echo "
						<script>
							groupHTML += `
									<div class='groupList'>
											<div class='groupMember'>$cardID - $name </div>
									</div>
							`;
						</script>
					";

				}

				//if not yet approve
				if($groupStatus==0){
					//Append html
					echo "
						<script>
							groupHTML += `
											<div class='groupBtn'>
												<form action ='' method='post'>
													<button name='approveGroup' value='$groupID' class='btn btn-success'>Approve</button>
													<button name='rejectGroup' type='button' value='$groupID' class='rejectGroupBtn btn btn-danger'>Reject</button>
												</form>
											</div>
									</div>
							`;
							$('.groupContent').append(groupHTML);
						</script>
					";
				}
				else if ($groupStatus==1){  //If approved
					echo "
						<script>
							groupHTML += `
											<div class='groupBtn'>
												<a href='kanban.php?id=$assID'><button class='btn btn-info'>Check kanban</button></a>
												<button disabled class='btn btn-disabled'>Approved</button>
											</div>
									</div>
							`;
							$('.groupContent').append(groupHTML);
						</script>
					";

				}
				else if ($groupStatus==2){  //If rejected
					echo "
						<script>
							groupHTML += `
											<div class='groupBtn'>
													<button disabled class='btn btn-disabled'>Waiting for update</button>
											</div>
									</div>
							`;
							$('.groupContent').append(groupHTML);
						</script>
					";

				}



			}

			//Get all the no group member

			//Get courseID from this assignemnt
			$sql= "select * from assignment where assignmentID =$assID";
			$result = mysqli_query($conn,$sql);
			$list = mysqli_fetch_assoc($result);
			$courseID = $list['courseID'];

			//Generate no group html code
			echo "
				<script>
					var groupHTML = `
							<div class='groupSection'>
									<div class='groupName'>
											No group
									</div>
					`;

				</script>
			";

			//Get all student from this course where they no yet have group
			$sql ="select * from user_course where courseID = $courseID and userID not in (
					select userID from group_member where assignmentID =$assID
				)";
			$result = mysqli_query($conn,$sql);
			while($list = mysqli_fetch_assoc($result))
			{

					$memberID = $list['userID'];
					$sql_user ="select * from users where userID = $memberID";
					$result_user = mysqli_query($conn, $sql_user);
					$list_user = mysqli_fetch_assoc($result_user);
					$name = $list_user['name'];
					$cardID = $list_user['cardID'];

					//Generate member html
					echo "
						<script>
							groupHTML += `
									<div class='groupList'>
											<div class='groupMember'>$cardID - $name </div>
									</div>
							`;
						</script>
					";
			}

			//Append html
			echo "
				<script>
					groupHTML += `
							</div>
					`;
					$('.groupContent').append(groupHTML);
				</script>
			";

		}



		//If post request detected
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

			//If update submission mark
			if(isset($_POST['mark']))
			{
				//Update mark
				$mark = $_POST['mark'];
				$assID =$_POST['assID'];
				$userID = $_POST['userID'];
				$sql = "UPDATE `assignment_submission` SET `score`=$mark WHERE assignmentID =$assID and userID =$userID";
				mysqli_query($conn,$sql);

				///Check assignment Type
				$sql= "select * from assignment where assignmentID =$assID";
				$result = mysqli_query($conn,$sql);
				$list_ass = mysqli_fetch_assoc($result);
				$assType = $list_ass['assignmentType'];

				if($assType == 0){		//If individual

						//Send notification to that student
						$sql_user  ="select * from users where userID = $userID";
						$result_user = mysqli_query($conn,$sql_user);
						$list_user = mysqli_fetch_assoc($result_user);
						$userName = $list_user['name'];
						$cardID = $list_user['cardID'];

						//Get assignment detail
						$sql ="select * from assignment where assignmentID = $assID";
						$result = mysqli_query($conn,$sql);
						$list = mysqli_fetch_assoc($result);
						$assName = $list['assignmentName'];
						$courseID = $list['courseID'];

						//Get course detail
						$sql="select * from course where courseID = $courseID";
						$result = mysqli_query($conn,$sql);
						$list = mysqli_fetch_assoc($result);
						$courseName = $list['courseCode'];

						//Create notification
						$sql = "INSERT INTO `notification`(`notificationMessage`, `notificationStatus`, `userID`, `notificationParent`) VALUES ('Course $courseName - $assName : Your submission mark is release',0,$userID,$USERID)";

						mysqli_query($conn,$sql);



				}
				else {		//If group


					//Get assignment detail
					$sql ="select * from assignment where assignmentID = $assID";
					$result = mysqli_query($conn,$sql);
					$list = mysqli_fetch_assoc($result);
					$assName = $list['assignmentName'];
					$courseID = $list['courseID'];

					//Get course detail
					$sql="select * from course where courseID = $courseID";
					$result = mysqli_query($conn,$sql);
					$list = mysqli_fetch_assoc($result);
					$courseName = $list['courseCode'];

					//Get all member from that group
					$sql ="select * from assignment_group where groupLeaderID = $userID";
					$result = mysqli_query($conn,$sql);
					$list = mysqli_fetch_assoc($result);
					$groupID = $list['groupID'];
					$sql ="select * from group_member where groupID = $groupID";
					$result = mysqli_query($conn,$sql);
					while($list = mysqli_fetch_assoc($result)){

						$studentID = $list['userID'];

						//Get user detail
						$sql_user  ="select * from users where userID = $studentID";
						$result_user = mysqli_query($conn,$sql_user);
						$list_user = mysqli_fetch_assoc($result_user);
						$userName = $list_user['name'];
						$cardID = $list_user['cardID'];

						//Create notification
						$sql = "INSERT INTO `notification`(`notificationMessage`, `notificationStatus`, `userID`, `notificationParent`) VALUES ('Course $courseName - $assName : Your submission mark is release',0,$studentID,$USERID)";

						mysqli_query($conn,$sql);

					}


					//Send notification  to everyone in that group

				}

				//Give response
				echo "
					<script>
						swal('Mark updated','','success').then((result) => {
								 window.location.href = window.location.href;
						})
					</script>
				";


			}


			//If approve group
			if(isset($_POST['approveGroup']))
			{

				//Update group status
				$groupID = $_POST['approveGroup'];
				$sql = "update assignment_group set status='1' where groupID= '$groupID' ";
				mysqli_query($conn,$sql);


				//Get course detail
				$sql ="select assignmentID from assignment_group where  groupID= '$groupID'";
				$result = mysqli_query($conn,$sql);
				$list = mysqli_fetch_assoc($result);
				$assID = $list['assignmentID'];

				$sql ="select * from assignment where assignmentID = $assID";
				$result = mysqli_query($conn,$sql);
				$list = mysqli_fetch_assoc($result);
				$assName = $list['assignmentName'];
				$courseID = $list['courseID'];

				$sql="select * from course where courseID = $courseID";
				$result = mysqli_query($conn,$sql);
				$list = mysqli_fetch_assoc($result);
				$courseName = $list['courseCode'];


				//Get group detail
				$sql ="select * from group_member where groupID = $groupID";
				$result = mysqli_query($conn,$sql);
				while($list = mysqli_fetch_assoc($result)){

					$student = $list['userID'];

					$sql = "INSERT INTO `notification`(`notificationMessage`, `notificationStatus`, `userID`, `notificationParent`) VALUES ('$courseName - $assName : Your group has been approved.',0,$student,$USERID)";
					mysqli_query($conn,$sql);
				}


				echo "
					<script>
						swal('Approved', '' ,'success').then(function (result) {
									window.location = window.location.href;
						});
					</script>
				";

			}

			//if reject group
			if(isset($_POST['rejectGroup']))
			{

				$reason = $_POST['reason'];

				//Update status
				$groupID = $_POST['rejectGroup'];
				$sql = "update assignment_group set status='2' where groupID= '$groupID' ";
				mysqli_query($conn,$sql);

				//Get course detail
				$sql ="select assignmentID from assignment_group where  groupID= '$groupID'";
				$result = mysqli_query($conn,$sql);
				$list = mysqli_fetch_assoc($result);
				$assID = $list['assignmentID'];

				$sql ="select * from assignment where assignmentID = $assID";
				$result = mysqli_query($conn,$sql);
				$list = mysqli_fetch_assoc($result);
				$assName = $list['assignmentName'];
				$courseID = $list['courseID'];

				$sql="select * from course where courseID = $courseID";
				$result = mysqli_query($conn,$sql);
				$list = mysqli_fetch_assoc($result);
				$courseName = $list['courseCode'];


				//Get group detail
				$sql ="select * from group_member where groupID = $groupID";
				$result = mysqli_query($conn,$sql);
				while($list = mysqli_fetch_assoc($result)){

					$student = $list['userID'];

					$sql = "INSERT INTO `notification`(`notificationMessage`, `notificationStatus`, `userID`, `notificationParent`) VALUES ('$courseName - $assName : Your group has been rejected because of $reason. Please edit your group again. ',0,$student,$USERID)";
					mysqli_query($conn,$sql);
				}


				echo "
					<script>
						swal('Rejected', '' ,'success').then(function (result) {
									window.location = window.location.href.split('#')[0];
						});
					</script>
				";




			}


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

					//Get course detail
					$sql_course = "select * from course where courseID = $courseID ";
					$result_course = mysqli_query($conn, $sql_course);
					$list_course = mysqli_fetch_assoc($result_course);
					$courseCode = $list_course['courseCode'];

					//Get current user from this course
					$sql_course_user = "select * from user_course where courseID = ' $courseID'";
					$result_course_user  = mysqli_query($conn, $sql_course_user);
					while($list_course_user  = mysqli_fetch_assoc($result_course_user)){

						$student = $list_course_user['userID'];

						//Create notification for all student
						$sql_noti =  "INSERT INTO `notification`(`notificationMessage`, `notificationStatus`, `userID`, `notificationParent`) VALUES ('Course $courseCode have new assignment',0,$student,$USERID)";
						mysqli_query($conn,$sql_noti);

					}

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

			//Upload material file function
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

						//Get course detail
						$sql_course = "select * from course where courseID = $courseID ";
						$result_course = mysqli_query($conn, $sql_course);
						$list_course = mysqli_fetch_assoc($result_course);
						$courseCode = $list_course['courseCode'];

						//Get current user from this course
						$sql_course_user = "select * from user_course where courseID = ' $courseID'";
						$result_course_user  = mysqli_query($conn, $sql_course_user);
						while($list_course_user  = mysqli_fetch_assoc($result_course_user)){

							$student = $list_course_user['userID'];

							//Create notification for all student
							$sql_noti =  "INSERT INTO `notification`(`notificationMessage`, `notificationStatus`, `userID`, `notificationParent`) VALUES ('Course $courseCode have upload new material',0,$student,$USERID)";
							mysqli_query($conn,$sql_noti);

						}

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
						<input type='hidden' class='assignmentID' value='$assignmentID'/>
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
