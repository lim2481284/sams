<?php

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


                  $sql_ass = "select * from assignment where courseID = $courseID";
                  $result_ass = mysqli_query($conn,$sql_ass);
                  while($list_ass = mysqli_fetch_assoc($result_ass))
                  {
                    $assName = $list_ass['assignmentName'];
                    $assDesc = $list_ass['assignmentDescription'];
                    $assDate = $list_ass['endDate'];
                    $assID = $list_ass['assignmentID'];


                    echo"
                    <div class='assList'>
                        <div class='assContent'>
                          <p class='assName'>$assName</p>
                          <p class='assDescription'>$assDesc</p>$assDate
                        </div>
                        <div class='assAction'>
                           <button class='submitBtn'> Submit </button>
                           <button class='kanbanBtn'> Kanban </button>
                        </div>
                    </div>
                    ";
                  }

          echo "  </div>
            <div id='materialTab' class='tab-pane fade'>
              ";

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
