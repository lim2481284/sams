<?php

  //Submit form group function
  if($_POST['formGroup']){

      $sql= "select * from users where userID = $USERID";
      $result = mysqli_query($conn, $sql);
      $list = mysqli_fetch_assoc($result);
      $name = $list['name'];

      $groupName = $_POST['groupName'];
      $assID = $_POST['formGroup'];
      $sql= "INSERT INTO `assignment_group`( `groupName`, `groupLeader`, `groupLeaderID`, `assignmentID`) VALUES ('$groupName','$name','$USERID','$assID')";
      $result = mysqli_query($conn,$sql);
      $id = mysqli_insert_id($conn);

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
                      $assType ='Individual';
                      $action = "
                        <button class='submitBtn'> Submit </button>
                      ";
                    }
                    else {
                      $assType ='Group of '.$groupSize;
                      $action = "
                        <a href='?formGroup=$assID'><button class='primaryBtn formGroupBtn' value='$assID'>  Form group </button></a>
                      ";
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

      //Grab assignment detail

      $sql = "select * from assignment where assignmentID = '$assID'";
      $result = mysqli_query($conn,$sql);
      $list_ass = mysqli_fetch_assoc($result);

      //Grab all student from the same course
      $courseID = $list_ass['courseID'];
      $groupSize = $list_ass['group_size'];
      $sql = "select * from user_course where courseID = '$courseID'";
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
                     <input id='check8' value='$userID' name='checkList[]' class='availableCheck checkbox styled' type='checkbox'>
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
                     <input id='check8' value='$userID' name='checkList[]' class='availableCheck checkbox styled' type='checkbox' checked disabled>
                     <label for='check8'>
                         <b> $cardID </b>  - $userName  (You)
                     </label>
                 </div>
                `;
              </script>
              ";

          }

      }

      //Append name list
      echo "
      <script>
        $('.memberList').append(nameList);
      </script>
      ";


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
