
<link href="assets/css/page-css/course_user.css" rel="stylesheet">
<link href="assets/css/main_user.css" rel="stylesheet">
<link href="assets/css/dropzone.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

<link href="assets/css/build.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="assets/js/dropzone.js"></script>

<div class='menu'></div>

<div class='bodyContent'>
    <div class='courseContent'>
    </div>

</div>
<div class='formGroupSection'>
  <div class='bodyContent'>
      <form id='groupForm' action='' method='post'>
        <label for="usr">Group name:</label>
        <input type="text" name='groupName' class="groupName form-control" id="usr">
        <br><br>
        <label for="usr" class='groupMemberLabel'></label>
        <div class='memberList'>

        </div>
        <br><br>
        <input type='hidden' name='formGroup' class='formGroup'/>
        <input type='hidden' name='editGroup' class='editGroup'/>
        <input type='hidden' name='groupSize' class='groupSize'/>
        <button type='button' class='btn btn-info FormGroupBtn'>Form group</button>
        <a href="javascript:history.go(-1)"><button type='button' class='btn btn-default '>Back</button></a>
        <br><br><br>
      </form>
  </div>
</div>


<div class='uploadSection '>
  <div class='uploadBox'>
    <div class='fileSection'>
        <div class='fileSection leftBtn'>
          <form id='fileForm' action="#" method="post" enctype="multipart/form-data">
            <input name='courseID' class='courseID' type='hidden'/>
            <div class="file-input-wrapper">
              <button class='btn btn-default addFile'>Click to upload </button>
              <input type="file" name="fileToUpload"  class='materialFileUpload' onchange="readURL(this);"/>
              <input type='hidden' name='assID' class='assIDForUpload'/> 
            </div>
            <input type='hidden' name='file'/>
          </form>
        </div>
    </div>
    <div class='uploadButtonSection'>
      <button type='button' class='submitFileBtn btn btn-info'>Submit </button>
      <button class='uploadBackBtn btn btn-default'>Back </button>
    </div>
  </div>
</div>


<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/page-js/course_user.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.0/sweetalert2.all.js"></script>
<!--php connection-->
<?php
include("assets/php/mysql_connect.inc.php");
include("assets/php/check_profile_student.php");
include("assets/php/student/course_function.php");
?>
