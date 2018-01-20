
<?php

		//Edit profile sql
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

			//Check enrollment key
			if(isset($_POST['enrollmentKey']))
			{
					$key = $_POST['enrollmentKey'];
					$id = $_POST['id'];
					$searchKey = $_POST['searchKey'];
				  $sql = "SELECT * FROM `course` WHERE courseID =$id and courseKey ='$key'";
					$result = mysqli_query($conn,$sql);
					if(mysqli_num_rows($result)==0){
						echo "
							<script>
								swal('Wrong enrollment key','','error');
							</script>
							";
					}
					else {

						//create user course for this user
						$sql = "insert into user_course (`userID`,`courseID`) values ('$USERID' ,'$id')";
					 	mysqli_query($conn,$sql);
							echo "
								<script>
									swal('Subject enrolled','','success');
								</script>
							";

						//Get current user name
						$sql= "select * from users where userID = $USERID";
			      $result = mysqli_query($conn, $sql);
			      $list = mysqli_fetch_assoc($result);
			      $name = $list['name'];


						//Get course name and lecturer id
						$sql= "select * from course where courseID = $id";
			      $result = mysqli_query($conn, $sql);
			      $list = mysqli_fetch_assoc($result);
			      $course = $list['courseCode'];
						$lecturer = $list['userID'];


						//Create notification for lecturer
						$sql = "INSERT INTO `notification`(`notificationMessage`, `notificationStatus`, `userID`, `notificationParent`) VALUES ('$name has enroll subject $course ',0,$lecturer,$USERID)";
					 	mysqli_query($conn,$sql);

					}

			}

			//user search course
			if(isset($_POST['searchCourse']))
			{
          $search = $_POST['searchInput'];
					$userCourseList = array();

					$sql = "select * from user_course where userID = '$USERID'  ";
					$result = mysqli_query($conn,$sql);
				  while($list = mysqli_fetch_assoc($result)){
							array_push($userCourseList,$list['courseID']);

					}

          $sql = "SELECT * FROM `course` WHERE courseName like '%$search%' or courseName like '$search%' or courseName like '%$search' or courseName like '$search' or courseCode like '$search' or courseCode like '%$search%' or courseCode like '$search%' or courseCode like '%$search' or lecturer_name like '%$search%' or lecturer_name like '$search%' or lecturer_name like '%$search' or lecturer_name like '$search' ";

          $result = mysqli_query($conn,$sql);
          if(mysqli_num_rows($result)==0){
            echo"
              <script>
                $('.searchResult').html('<label class=\"noResult\"> No result ... </label>');
                $('.searchResult').css('text-align','center');
              </script>
            ";
          }
          while($list = mysqli_fetch_assoc($result)){
              $courseCode = $list['courseCode'];
              $courseName = $list['courseName'];
              $lecturerName = $list['lecturer_name'];
              $courseID = $list['courseID'];


              echo "
                <script>
                    $('.searchResult').append(`
                      <div class='searchList'>
                          <div class='listContent'>
                              <b>$courseCode </b>
                              <p>$courseName</p>
                              <small> $lecturerName </small>
                           </div>
                          <div class='listAction'>";
														$check =0;
														$arrlength = count($userCourseList);
														for($x = 0; $x < $arrlength; $x++) {
																	if($userCourseList[$x] == $courseID){
																				$check++;
																	}

														}
														if($check==0){
															echo" <button class='enrollBtn' value='$courseID'>Enroll</button>";
														}
														else {
															echo "<a href='course_student.php?courseID=$courseID'><button class='viewCourseBtn' value='$courseID'>View</button></a>";
														}

                        echo"  </div>
                      </div>
                    `);
                </script>
              ";
          }
						echo "<script> $('.searchResult').append(\"<input type='hidden' value='$search' id='searchKey'/>\") </script>";
      }

    }


     ?>
