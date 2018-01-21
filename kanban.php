<link href="assets/css/page-css/dashboard_user.css" rel="stylesheet">
<link href="assets/css/page-css/profile_user.css" rel="stylesheet">
<link href="assets/css/main_user.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/lib/jQuery/jquery.ui.min.css" />
<link rel="stylesheet" href="assets/css/todo.css" />
<div class='bg'></div>
<div class='body'>
  <a href="javascript: history.go(-1)"><button class='btn btn-default'>Back </button></a>
  <br><br>
  <div id="kanbanBody container">

    <div class=" task-list addTask">

        <form id="todo-form">
            <input type="text" class="form-control" placeholder="Title" />
            <textarea  class="form-control" placeholder="Description"></textarea>
            <input type="text"  class="form-control" id="datepicker" placeholder="Due Date (dd/mm/yyyy)" />
            <br>
            <input type="button" class="formBtn btn btn-primary" value="Add Task" onclick="todo.add();" />
        </form>

        <input type="button" class="formBtn btn btn-danger" value="Clear Data" onclick="todo.clear();" />

        <div id="delete-div">
            Drag Here to Delete
        </div>
        <br><br>
    </div>
      <div class="task-list task-container" id="pending">
          <h3>Pending</h3>
          <!--<div class="todo-task">
              <div class="task-header">Sample Header</div>
              <div class="task-date">25/06/1992</div>
              <div class="task-description">Lorem Ipsum Dolor Sit Amet</div>
          </div>-->
      </div>

      <div class="task-list task-container" id="inProgress">
          <h3>In Progress</h3>
      </div>

      <div class="task-list task-container" id="completed">
          <h3>Completed</h3>
      </div>





  </div>
</div>


<script src="assets/js/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src='assets/js/jquery.min.js'></script>
<script src="assets/js/page-js/dashboard_user.js" type="text/javascript"></script>
<div style="clear:both;"></div>
<script type="text/javascript" src="assets/lib/jQuery/jquery.min.js"></script>
<script type="text/javascript" src="assets/lib/Bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="assets/lib/jQuery/jquery.ui.min.js"></script>
<script type="text/javascript" src="assets/js/todo.js"></script>

<script type="text/javascript">
    $( "#datepicker" ).datepicker();
    $( "#datepicker" ).datepicker("option", "dateFormat", "dd/mm/yy");

    $(".task-container").droppable();
    $(".todo-task").draggable({ revert: "valid", revertDuration:200 });
    todo.init();
</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.0/sweetalert2.all.js"></script>
<!--php connection-->
<?php
include("assets/php/mysql_connect.inc.php");
include("assets/php/student/dashboard.php");
?>
