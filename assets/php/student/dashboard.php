<?php
	session_start();


	//Get all notification
	$sql = "select * from notification where userID='$USERID' order by created_at DESC";
	$result = mysqli_query($conn,$sql);

	while($list = mysqli_fetch_assoc($result)){
			$message = $list['notificationMessage'];
			$createDate = $list['created_at'];
			echo "
			<script>
				$('.notificationList').append(`
					<div class='notification col-sm-12'>
							<div class='col-sm-10 notiContent'>$message</div>
							<div class='col-sm-2 notificationDate'>$createDate</div>
					</div>
				`);
			</script>
			";

	}


	//Declaration for Generate calander event list
	echo "
	<script>
		var myEvents = [];
	</script>
	";


	//Check if user have course or not
  $sql = "select * from user_course where userID = $USERID";
  $result = mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)==0)
  {
    echo "<script>
      $('.bodyContent').html(`
        <p class=\"emptyLabel\">You don't have any course </p>
        <br>
        <div class=\"buttonSection\">
          <a href='search_student.php'><button class=\"findCourseBtn\">Add now</button></a>
        </div>
      `);


    </script>";
  }

	//Grab assignment list
	/*
		1 - get all user registered course
		2 - get all course name
		3 - get all assignment
	*/

	$sql = "select * from user_course where userID = $USERID";
  $result = mysqli_query($conn,$sql);
	$count =0;
	while($list=mysqli_fetch_assoc($result)){
			$courseID = $list['courseID'];
			$sql_get_ass = "select * from course where courseID = $courseID";
			$result_ass = mysqli_query($conn,$sql_get_ass);
			$list_ass=mysqli_fetch_assoc($result_ass);

			$courseName = $list_ass['courseName'];
			$courseCode = $list_ass['courseCode'];

			$ass_sql = "select * from assignment where courseID = $courseID";
		  $ass_result = mysqli_query($conn,$ass_sql);
			$ass_size = mysqli_num_rows($ass_result);
			echo"
				<script>
					var assHTML=`
						<div class='panel panel-default'>
							<a data-toggle='collapse' data-parent='#accordion' href='#collapse$count'>
						  <div class='panel-heading'>
										<p class='courseCode' value='$courseID'>$courseCode</p>
										<p class='courseName'> $courseName </p>
						  </div>
							</a>
							 <div id='collapse$count' class='panel-collapse collapse'>
					`;
				</script>
			";




			if($ass_size==0)
			{
				echo"
					<script>
						 assHTML+=`
						 <div class='panel-body'>
						 	No assignment
						 </div>
						</div>
						`;
					</script>
				";
			}


			//Get all assignment
			while($ass_list=mysqli_fetch_assoc($ass_result)){
					$assName = $ass_list['assignmentName'];
					$assDesc = $ass_list['assignmentDescription'];
					$assDate = $ass_list['endDate'];

					//Create assignment list and generate calander
					echo "
					<script>
						myEvents.push({title:'$assName deadline',start:'$assDate'});
						assHTML+=`
						<div class='panel-body'>
									<div class='assList'>
											<div class='assContent'>
												<p class='assName'>$assName ($assType)</p>
												<p class='assDate'>$assDate</p>
												<p class='assDescription'>$assDesc</p>
											</div>
											<div class='assAction'>
												 <a href='course_student.php?courseID=$courseID'><button class='viewBtn submitBtn'> View </button></a>
											</div>
									</div>
								</div>
						`;
					</script>";

			}


			echo"
				<script>
					assHTML+='</div>';
					$('.assBody').prepend(assHTML);
				</script>
			";
			$count++;
	}


	//Final script for generate calander
	echo "
	<script>
		$(document).ready(function(){
			$('#calendar').fullCalendar({
				editable: true,
				eventLimit: true,
				events: myEvents
			});
		});
	</script>
	";


?>
