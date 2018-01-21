<?php


  //Upload submission function
	if(isset($_POST['file']))
	{
		$assID = $_POST['assID'];
		$name= $assID.$USERID.basename($_FILES["fileToUpload"]["name"]);
		$target_dir = "assets/img/submission/";
		$target_file = $target_dir . $name;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	 	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

			//Check if there is submission before
			$sql = "select * from assignment_submission where assignmentID = $assID and userID = $USERID";
			$result = mysqli_query($conn,$sql);
			$list = mysqli_fetch_assoc($result);
			$count = mysqli_num_rows($result);

			//If user submit before, then replace
			if($count >0){
				$sql="UPDATE `assignment_submission` set `submission_link` = '$name' where assignmentID = $assID and userID = $USERID  ";
			}
			else { //else insert new record
				$sql="insert into assignment_submission (`userID`,`assignmentID`,`submission_link`) values ('$USERID', '$assID', '$name')";
			}


			if(mysqli_query($conn,$sql))
			{


				//Get username
				$sql_user = "select * from users where userID =$USERID";
				$result_user = mysqli_query($conn,$sql_user);
				$list_user = mysqli_fetch_assoc($result_user);
				$userName  = $list_user['name'];
				$cardID = $list_user['cardID'];

				//Get course ID
				$sql_ass = " select * from assignment where assignmentID = $assID";
				$result_ass = mysqli_query($conn, $sql_ass);
				$list_ass = mysqli_fetch_assoc($result_ass);
				$courseID = $list_ass['courseID'];
				$assName = $list_ass['assignmentName'];
				$type=$list_ass['assignmentType'];

				//Get course detail
				$sql_course = "select * from course where courseID = $courseID ";
				$result_course = mysqli_query($conn, $sql_course);
				$list_course = mysqli_fetch_assoc($result_course);
				$courseCode = $list_course['courseCode'];
				$lecturer = $list_course['userID'];

				//If assingment type is individual : Send username with ID to lecturer as notifciation
				if($type =='0')
				{
					//Create notification for lecturer
					$sql_noti =  "INSERT INTO `notification`(`notificationMessage`, `notificationStatus`, `userID`, `notificationParent`) VALUES ('Course $courseCode - $assName have new submission from $cardID - $userName ',0,$lecturer,$USERID)";
					mysqli_query($conn,$sql_noti);

				}
				else {  	//If assignemnt type is group : Send group name to lecturer as notification

					$sql_g = "select * from assignment_group where groupLeaderID = $USERID and assignmentID=$assID";
					$result_g = mysqli_query($conn,$sql_g);
					$list_g = mysqli_fetch_assoc($result_g);
					$groupName = $list_g['groupName'];

					//Create notification for lecturer
					$sql_noti =  "INSERT INTO `notification`(`notificationMessage`, `notificationStatus`, `userID`, `notificationParent`) VALUES ('Course $courseCode - $assName have new submission from group $groupName ',0,$lecturer,$USERID)";
					mysqli_query($conn,$sql_noti);

				}

				//Give response to user
				echo"
				<script>
					swal({
					  title: 'Assignment submitted',
					  type: 'success',
					  showCancelButton: false
					}).then((result) => {
							window.location.href = window.location.href;
					})
				</script>
				";
			}
		} else {
			echo "Sorry, there was an error uploading your file.";
		}


	}


  //Edit group function
  if($_POST['editGroup']){

    //Get latest detail
    $groupID = $_POST['editGroup'];
    $groupName = $_POST['groupName'];

    //Clear current group member
    $sql="delete from group_member where groupID = $groupID";
    mysqli_query($conn,$sql);

    //Get assignment ID
    $sql = "select * from assignment_group where groupID = $groupID";
    $result = mysqli_query($conn,$sql);
    $list = mysqli_fetch_assoc($result);
    $assID = $list['assignmentID'];


    //Get current user detail
    $sql= "select * from users where userID = $USERID";
    $result = mysqli_query($conn, $sql);
    $list = mysqli_fetch_assoc($result);
    $name = $list['name'];

    //Edit group
    $groupName = $_POST['groupName'];
    $sql= "UPDATE `assignment_group` SET `groupName`='$groupName',`status`=0 WHERE groupID = $groupID";
    mysqli_query($conn,$sql);




    //Get assignemnt detail
    $sql_ass = "select * from assignment where assignmentID = $assID";
    $result_ass = mysqli_query($conn,$sql_ass);
    $list_ass = mysqli_fetch_assoc($result_ass);
    $assName = $list_ass['assignmentName'];
    $courseID = $list_ass['courseID'];

    //Get course detail
    $sql_c= "select * from course where courseID = $courseID";
    $result_c= mysqli_query($conn,$sql_c);
    $list_c = mysqli_fetch_assoc($result_c);
    $courseCode  = $list_c['courseCode'];
    $lecturer = $list_c['userID'];


    //Send notification to lecturer
    $sql = "INSERT INTO `notification`(`notificationMessage`, `notificationStatus`, `userID`, `notificationParent`) VALUES ('Course $courseCode - $assName : Group $groupName have update their group ',0,$lecturer,$USERID)";
    mysqli_query($conn,$sql);

    //Create member data for each group member
    foreach($_POST['checkList'] as $selected){
      $sql= "INSERT INTO `group_member`( `groupID`, `userID`, `assignmentID`) VALUES ('$groupID','$selected','$assID')";
      mysqli_query($conn,$sql);
    }
    $sql= "INSERT INTO `group_member`( `groupID`, `userID`, `assignmentID`) VALUES ('$groupID','$USERID','$assID')";
    mysqli_query($conn,$sql);


    echo "
      <script>
        swal('Group edited, waiting for approve','','success').then((result) => {
            location.href='course_student.php';
        })
      </script>
    ";


  }

  //Submit form group function
  if($_POST['formGroup']){

      //Get current user detail
      $sql= "select * from users where userID = $USERID";
      $result = mysqli_query($conn, $sql);
      $list = mysqli_fetch_assoc($result);
      $name = $list['name'];

      //Create new group
      $groupName = $_POST['groupName'];
      $assID = $_POST['formGroup'];
      $sql= "INSERT INTO `assignment_group`( `groupName`, `groupLeader`, `groupLeaderID`, `assignmentID`) VALUES ('$groupName','$name','$USERID','$assID')";
      $result = mysqli_query($conn,$sql);
      $id = mysqli_insert_id($conn);


      //Get assignemnt detail
      $sql_ass = "select * from assignment where assignmentID = $assID";
      $result_ass = mysqli_query($conn,$sql_ass);
      $list_ass = mysqli_fetch_assoc($result_ass);
      $assName = $list_ass['assignmentName'];
      $courseID = $list_ass['courseID'];

      //Get course detail
      $sql_c= "select * from course where courseID = $courseID";
      $result_c= mysqli_query($conn,$sql_c);
      $list_c = mysqli_fetch_assoc($result_c);
      $courseCode  = $list_c['courseCode'];
      $lecturer = $list_c['userID'];


      //Send notification to lecturer
      $sql = "INSERT INTO `notification`(`notificationMessage`, `notificationStatus`, `userID`, `notificationParent`) VALUES ('Course $courseCode - $assName have new group register named $groupName',0,$lecturer,$USERID)";
      mysqli_query($conn,$sql);

      //Create member data for each group member
      foreach($_POST['checkList'] as $selected){
        $sql= "INSERT INTO `group_member`( `groupID`, `userID`, `assignmentID`) VALUES ('$id','$selected','$assID')";
        mysqli_query($conn,$sql);
      }
      $sql= "INSERT INTO `group_member`( `groupID`, `userID`, `assignmentID`) VALUES ('$id','$USERID','$assID')";
      mysqli_query($conn,$sql);


      echo "
        <script>
          swal('Group created, waiting for approve','','success').then((result) => {
              location.href='course_student.php';
          })
        </script>
      ";
  };



  //Grab all the course content , assigment and material
  if($_GET['courseID']){
      $courseID = $_GET['courseID'];
      $sql = "select * from course where courseID = $courseID";
      $result = mysqli_query($conn,$sql);
      $list = mysqli_fetch_assoc($result);

      $courseName = $list['courseName'];
      $courseCode = $list['courseCode'];
      $lecturerName = $list['lecturer_name'];
      $courseDescription = $list['courseDescription'];

      echo "
      <script>
        $('.menu').hide();
        $('.courseContent').prepend(`
          <a href='course_student.php'><button class='backBtn'>Back </button></a>
          <p class='courseInfo'>Course code : $courseCode</p>
          <p class='courseInfo'>Course name : $courseName</p>
          <p class='courseInfo'>Course description : $courseDescription</p>
          <p class='courseInfo'>Lecturer name : $lecturerName</p>
          <ul class='nav nav-tabs'>
            <li class='active'><a data-toggle='tab' href='#assTab'>Assignment</a></li>
            <li><a data-toggle='tab' href='#materialTab'>Material</a></li>
          </ul>

          <div class='tab-content'>
            <div id='assTab' class='tab-pane fade in active'>";

                  //Get all assignment
                  $sql_ass = "select * from assignment where courseID = $courseID order by endDate DESC";
                  $result_ass = mysqli_query($conn,$sql_ass);
                  while($list_ass = mysqli_fetch_assoc($result_ass))
                  {


                    $assName = $list_ass['assignmentName'];
                    $assDesc = $list_ass['assignmentDescription'];
                    $assDate = $list_ass['endDate'];
                    $assType = $list_ass['assignmentType'];
                    $groupSize = $list_ass['group_size'];
                    $assID = $list_ass['assignmentID'];
                    $today = date("Y-m-d");



                    //Check assignment type
                    if($assType == 0)
                    {

											//Check submission
											$sql_sub = "select * from assignment_submission where assignmentID = $assID and userID = $USERID";
											$result_sub = mysqli_query($conn,$sql_sub);
											$list_sub = mysqli_fetch_assoc($result_sub);
											$score = $list_sub['score'];

											if($score){
												$action = "
													<input type='hidden' class='assID' name='assID' value='$assID'/>
	                        <button class='submitBtn' disabled> $score mark </button>
	                      ";
											}else {
												$action = "
													<input type='hidden' class='assID' name='assID' value='$assID'/>
	                        <button class='submitBtn'> Submit </button>
	                      ";

											}

                      $assType ='Individual';

                    }
                    else {
                      $assType ='Group of '.$groupSize;
                      $action = "
                        <a href='?formGroup=$assID'><button class='primaryBtn formGroupBtn' value='$assID'>  Form group </button></a>
                      ";
                    }

                    //Check this user form group already or not
                    $sql_group = "select * from group_member where assignmentID = $assID and userID = $USERID";
                    $result_group = mysqli_query($conn, $sql_group);
                    $list_group = mysqli_fetch_assoc($result_group);
                    $groupID = $list_group['groupID'];
                    $count = mysqli_num_rows($result_group);

                    if($count>0){

                      //Check status of the group
                      $sql_group = "select * from assignment_group where groupID =$groupID";
                      $result_group = mysqli_query($conn, $sql_group);
                      $list_group = mysqli_fetch_assoc($result_group);
                      $groupLead = $list_group['groupLeaderID'];
                      $status = $list_group['status'];

                      //If not yet approve
                      if($status == 0  || $status == 2){

                        //If user is group leadaer : only group leader can edit group
                        if($groupLead == $USERID){

                          $action = "
                          <a href='?formGroup=$assID'>
                            <button class='primaryBtn formGroupBtn' value='$assID'>  Edit group </button>
                          </a>
                          ";

                        }
                        else {
                          $action = "
                            <a href='?formGroup=$assID'>
                              <button class='primaryBtn formGroupBtn' value='$assID'>  Check group </button>
                            </a>
                          ";

                        }

                      }
                      else {

                        //If user is group leadaer : only group leadaer can submit
                        if($groupLead == $USERID){

													//Check submission
													$sql_sub = "select * from assignment_submission where assignmentID = $assID and userID = $USERID";
													$result_sub = mysqli_query($conn,$sql_sub);
													$list_sub = mysqli_fetch_assoc($result_sub);
													$score = $list_sub['score'];

													if($score){
														$action = "
															<input type='hidden' class='assID' name='assID' value='$assID'/>
			                        <button class='submitBtn' disabled> $score mark </button>
			                      ";
													}else {
														$action = "
	                          <div class='form-group '>
	                            <input type='hidden' name='assID' class='assID' value='$assID'/>
	                            <select class='selectAction form-control''>
	                              <option value='' disabled selected>Choose action ... </option>
	                              <option value='checkGroup'>Check group </option>
	                              <option value='kanban'>Kanban</option>
	                              <option value='submit'>Submit</option>
	                            </select>
	                          </div>
	                          ";
													}


                        }
                        else {

													//Check submission
													$sql_sub = "select * from assignment_submission where assignmentID = $assID and userID = $groupLead";
													$result_sub = mysqli_query($conn,$sql_sub);
													$list_sub = mysqli_fetch_assoc($result_sub);
													$score = $list_sub['score'];

													if($score){
														$action = "
															<input type='hidden' class='assID' name='assID' value='$assID'/>
															<button class='submitBtn' disabled> $score mark </button>
														";
													}else {
	                          $action = "
	                          <div class='form-group '>
	                              <input type='hidden' class='assID' value='$assID'/>
	                            <select class='selectAction form-control''>
	                              <option value='' disabled selected>Choose action ... </option>
	                              <option value='checkGroup'>Check group </option>
	                              <option value='kanban'>Kanban</option>
	                            </select>
	                          </div>
	                          ";
													}
                        }

                      }
                    }


                    //Check deadline
                    if($assDate < $today){
                      $action = "
                        <button class='defaultBtn passedBtn' disabled> Passed </button>
                      ";
            				}

                    echo"
                    <div class='assList'>
                        <div class='assContent'>
                          <p class='assName'>$assName ($assType)</p>
                          <p class='assDate'>$assDate</p>
                          <p class='assDescription'>$assDesc</p>
                        </div>
                        <div class='assAction'>
                           $action
                        </div>
                    </div>
                    ";
                  }

          echo "  </div>
            <div id='materialTab' class='tab-pane fade'>
              ";

            //Get all material
            $sql_material = "select * from course_material where courseID = $courseID";
            $result_material = mysqli_query($conn,$sql_material);
            while($list_material = mysqli_fetch_assoc($result_material))
            {
              $materialName = $list_material['material_link'];

              echo"
                <div class='materialList'>
                    <div class='materialName'> $materialName</div>
                    <div class='materialAction'>
                      <a href='./assets/img/material/$materialName' download>  <button class='downloadBtn'> Download </button></a>
                    </div>
                </div>
              ";
            }

            echo
            "
            </div>

          </div>


        `);

      </script>
      ";

  }
  else if($_GET['formGroup']){   //If form group

      //Switch interface
      $assID = $_GET['formGroup'];
      echo"
        <script>
          $('.menu').hide();
          var nameList='';

          $(document).ready(function(){
              $('.formGroupSection').addClass('overlay');
              $('.formGroup').val($assID);
          });

        </script>
      ";

      //Check if user have group or not
      $sql_group = "select * from group_member where userID = $USERID";
      $result_group = mysqli_query($conn,$sql_group);
      $list_group = mysqli_fetch_assoc($result_group);
      $groupID = $list_group['groupID'];
      $count = mysqli_num_rows($result_group);

      //If user have group
      if($count >0){

          echo "<script>$('.formGroup').remove();</script>";

          //Get group detail and Check the status of the group
          $sql ="select * from assignment_group where groupID = $groupID";
          $result = mysqli_query($conn, $sql);
          $list = mysqli_fetch_assoc($result);
          $groupName = $list['groupName'];
          $groupLeadID = $list['groupLeaderID'];
          $groupLead = $list['groupLeader'];
          $status = $list['status'];

          if($status == 0 || $status == 2){ //If not approve
            if($groupLeadID != $USERID) // If user is not leader
            {
              echo "
                <script>
                    $('.groupName').val('$groupName');
                    $('.groupName').attr('disabled','disabled');
                    $('.FormGroupBtn').remove();
                    nameList+=`
                      Group leader : $groupLead
                      <br>
                    `;
                </script>
              ";

              //Generate name list based on same group
              $sql_group = "select * from group_member where groupID = $groupID";
              $result_group = mysqli_query($conn,$sql_group);
              while($list_group = mysqli_fetch_assoc($result_group)){
                  $userID = $list_group['userID'];
                  $sql_user = "select * from users where userID = $userID";
                  $result_user = mysqli_query($conn,$sql_user);
                  $list_user = mysqli_fetch_assoc($result_user);
                  $userName = $list_user['name'];
                  $cardID = $list_user['cardID'];
                  echo"
                    <script>
                      nameList+=`

                      <br>
                      <div class='checkbox  checkbox-circle'>
                           <input id='check8' value='$userID' class='checkbox styled' checked disabled type='checkbox'>
                           <label for='check8'>
                               <b> $cardID </b> - $userName
                           </label>
                       </div>

                      `;
                    </script>
                    ";

              }
            }
            else {    //If user is leader
              echo "
                <script>
                    $('.groupName').val('$groupName');
                    $('.FormGroupBtn').html('Edit group');
                    $('.editGroup').val($groupID);
                </script>
              ";
              //Grab assignment detail

              $sql = "select * from assignment where assignmentID = '$assID'";
              $result = mysqli_query($conn,$sql);
              $list_ass = mysqli_fetch_assoc($result);

              //Grab all student from the same course
              $courseID = $list_ass['courseID'];
              $groupSize = $list_ass['group_size'];
              $sql = "select * from user_course where courseID = '$courseID' and userID not in (
                  select userID from group_member where assignmentID = $assID and groupID != $groupID
                )";
              $result = mysqli_query($conn,$sql);

              //Change group size emptyLabel
              echo "<script>
                  $('.groupSize').val($groupSize);
                  $('.groupMemberLabel').html('Select your group member (Max $groupSize)')
                </script>";

              //Generate name list based on the student from the same course
              while($list_course = mysqli_fetch_assoc($result)){

                  //Get user detail
                  $userID = $list_course['userID'];
                  $sql_user = "select * from users where userID = $userID";
                  $result_user = mysqli_query($conn,$sql_user);
                  $list_user = mysqli_fetch_assoc($result_user);
                  $userName = $list_user['name'];
                  $cardID = $list_user['cardID'];

                  if($userID != $USERID)
                  {
                    $sql_check = "select * from group_member where userID = $userID";
                    $result_check = mysqli_query($conn,$sql_check);
                    $count = mysqli_num_rows($result_check);

                    //If user is in the group
                    if($count >0){
                      echo"
                        <script>
                          nameList+=`
                          <br>
                          <div class='checkbox checkbox-info checkbox-circle'>
                               <input id='check8' value='$userID' name='checkList[]' checked class='check$userID availableCheck checkbox styled' type='checkbox'>
                               <label for='check8'>
                                   <b> $cardID </b> - $userName
                               </label>
                           </div>

                          `;
                        </script>
                        ";
                    }
                    else {
                      echo"
                        <script>
                          nameList+=`
                          <br>
                          <div class='checkbox checkbox-info checkbox-circle'>
                               <input id='check8' value='$userID' name='checkList[]' class='check$userID availableCheck checkbox styled' type='checkbox'>
                               <label for='check8'>
                                   <b> $cardID </b> - $userName
                               </label>
                           </div>

                          `;
                        </script>
                        ";
                    }
                  }
                  else {
                    echo"
                      <script>
                        nameList+=`
                        <br>
                        <div class='checkbox checkbox-info checkbox-circle'>
                             <input id='check8' value='$userID' name='checkList[]' class='check$userID  availableCheck checkbox styled' type='checkbox' checked disabled>
                             <label for='check8'>
                                 <b> $cardID </b>  - $userName  (You)
                             </label>
                         </div>
                        `;
                      </script>
                      ";

                  }

              }

            }

          }
          else if ($status == 1){ //If approved

            echo "
              <script>
                  $('.groupName').val('$groupName');
                  $('.groupName').attr('disabled','disabled');
                  $('.FormGroupBtn').remove();
                  nameList+=`
                    Group leader : $groupLead
                    <br>
                  `;
              </script>
            ";

            //Generate name list based on same group
            $sql_group = "select * from group_member where groupID = $groupID";
            $result_group = mysqli_query($conn,$sql_group);
            while($list_group = mysqli_fetch_assoc($result_group)){
                $userID = $list_group['userID'];
                $sql_user = "select * from users where userID = $userID";
                $result_user = mysqli_query($conn,$sql_user);
                $list_user = mysqli_fetch_assoc($result_user);
                $userName = $list_user['name'];
                $cardID = $list_user['cardID'];
                echo"
                  <script>
                    nameList+=`

                    <br>
                    <div class='checkbox  checkbox-circle'>
                         <input id='check8' value='$userID' class='checkbox styled' checked disabled type='checkbox'>
                         <label for='check8'>
                             <b> $cardID </b> - $userName
                         </label>
                     </div>

                    `;
                  </script>
                  ";

            }

          }


          echo "
          <script>
            $('.memberList').append(nameList);
          </script>
          ";
      }
      else {  //If user dont have group

        //Grab assignment detail

        $sql = "select * from assignment where assignmentID = '$assID'";
        $result = mysqli_query($conn,$sql);
        $list_ass = mysqli_fetch_assoc($result);

        //Grab all student from the same course
        $courseID = $list_ass['courseID'];
        $groupSize = $list_ass['group_size'];
        $sql = "select * from user_course where courseID = '$courseID' and userID not in (
            select userID from group_member where assignmentID = $assID
          )";
        $result = mysqli_query($conn,$sql);

        //Change group size emptyLabel
        echo "<script>
            $('.groupSize').val($groupSize);
            $('.groupMemberLabel').html('Select your group member (Max $groupSize)')
          </script>";

        //Generate name list based on the student from the same course
        while($list_course = mysqli_fetch_assoc($result)){

            //Get user detail
            $userID = $list_course['userID'];
            $sql_user = "select * from users where userID = $userID";
            $result_user = mysqli_query($conn,$sql_user);
            $list_user = mysqli_fetch_assoc($result_user);
            $userName = $list_user['name'];
            $cardID = $list_user['cardID'];

            if($userID != $USERID)
            {
              echo"
                <script>
                  nameList+=`
                  <br>
                  <div class='checkbox checkbox-info checkbox-circle'>
                       <input id='check8' value='$userID' name='checkList[]' class='check$userID availableCheck checkbox styled' type='checkbox'>
                       <label for='check8'>
                           <b> $cardID </b> - $userName
                       </label>
                   </div>

                  `;
                </script>
                ";
            }
            else {
              echo"
                <script>
                  nameList+=`
                  <br>
                  <div class='checkbox checkbox-info checkbox-circle'>
                       <input id='check8' value='$userID' name='checkList[]' class='check$userID  availableCheck checkbox styled' type='checkbox' checked disabled>
                       <label for='check8'>
                           <b> $cardID </b>  - $userName  (You)
                       </label>
                   </div>
                  `;
                </script>
                ";

            }

        }


        /*Show student list that already have group

            //Disabled stuent list that already have group
            $sql = "select * from user_course where courseID = '$courseID' and userID in (
              select userID from group_member where assignmentID = $assID
            )";
            $result = mysqli_query($conn,$sql);
            while($list  = mysqli_fetch_assoc($result))
            {
              echo"
                <script>
                  nameList+=`
                  <br>
                  <div class='checkbox checkbox-danger checkbox-circle'>
                       <input id='check7' value='$userID'  class='check$userID  checkbox styled' type='checkbox' checked disabled>
                       <label for='check7'>
                           <b> $cardID </b>  - $userName  (You)
                       </label>
                   </div>
                  `;
                </script>
                ";

            }

        */

        //Append name list
        echo "
        <script>
          $('.memberList').append(nameList);
        </script>
        ";
    }

  }
  else          //Grab all the course list
  {


      $sql = "select * from user_course where userID = $USERID";
      $result = mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)==0)
      {
        echo "<script>
          $('.bodyContent').html(`
            <p class=\"emptyLabel\">You don't have any course </p>
            <br>
            <div class=\"buttonSection\">
              <button class=\"findCourseBtn\">Add now</button>
            </div>
          `);


        </script>";
      }else {
        	$sql = "select * from user_course where userID = '$USERID'  ";
          $result = mysqli_query($conn,$sql);
          while($list = mysqli_fetch_assoc($result)){
              $courseID = $list['courseID'];
              $sql_get_course  = "select * from course where courseID = '$courseID'";
              $result_get_course = mysqli_query($conn,$sql_get_course);
              while($course_list = mysqli_fetch_assoc($result_get_course)){
                $courseCode = $course_list['courseCode'];
                $courseName = $course_list['courseName'];
                $lecturerName = $course_list['lecturer_name'];
                echo"
                  <script>
                    $('.courseContent').prepend(`
                      <div class='courseList'>
                          <div class='listContent'>
                              <b>$courseCode </b>
                              <p>$courseName</p>
                              <small> $lecturerName </small>
                           </div>
                          <div class='listAction'>
                            <a href='?courseID=$courseID'><button class='viewCourseBtn' value='$courseID'>View</button></a>
                            </div>
                        </div>
                      `);
                  </script>

                ";

              }

          }

      }
}

?>
