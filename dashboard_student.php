<link href="assets/css/page-css/dashboard_user.css" rel="stylesheet">
<link href="assets/css/page-css/profile_user.css" rel="stylesheet">
<link href="assets/css/main_user.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href='assets/css/fullcalendar.css' rel='stylesheet' />
<link href='assets/css/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<div class='menu'></div>

<div class='bodyContent'>

    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#notification">Notification</a></li>
      <li><a data-toggle="tab" href="#ass">Assignment list</a></li>
      <li><a data-toggle="tab" href="#calander">Calander</a></li>
    </ul>

    <div class="tab-content">
      <div id="notification" class="tab-pane fade in active notificationList">
      </div>
      <div id="ass" class="tab-pane fade assBody">
        <div class="panel-group" id="accordion">

        </div>
      </div>
      <div id="calander" class="tab-pane fade calBody">
        <br><br>
        <div id='calendar'></div>

      </div>

    </div>


</div>

<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src='assets/js/jquery.min.js'></script>
<script src='assets/js/moment.min.js'></script>
<script src='assets/js/fullcalendar.js'></script>
<script src="assets/js/page-js/dashboard_user.js" type="text/javascript"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.0/sweetalert2.all.js"></script>
<!--php connection-->
<?php
include("assets/php/mysql_connect.inc.php");
include("assets/php/check_profile_student.php");
include("assets/php/student/dashboard.php");
?>
