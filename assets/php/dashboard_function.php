

<?php

    //Get all the course list and student list
		$sql = "select * from course where userID='$USERID'";
		$result = mysqli_query($conn,$sql);
		while($list = mysqli_fetch_assoc($result)){

			$courseID = $list['courseID'];
			$courseCode = $list['courseCode'];
			$courseName = $list['courseName'];
			echo "
				<script>
					$('.courseList').append(`
						<option class='$courseID' value='$courseID'>$courseCode - $courseName </option>
					`);
					var tableHTML =`
					<table class='table$courseID table table-hover'>
						<thead>
							<tr>
								<th>#</th>
								<th>ID</th>
								<th>Name</th>
								<th>Email</th>
								<th>Contact</th>
								<th>Address</th>
							</tr>
						</thead>
						<tbody>
					`;
				</script>
			";

			$sql_student = "select * from user_course where courseID='$courseID'";
			$result_student = mysqli_query($conn,$sql_student);
			$count=1;
			while($list_student = mysqli_fetch_assoc($result_student)){
					$studentID = $list_student['userID'];
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
						tableHTML+= `
								<tr>
									<th scope='row'>$count</th>
									<td>$cardID</td>
									<td>$studentName</td>
									<td>$studentEmail</td>
									<td>$studentContact</td>
									<td>$studentAddress</td>
								</tr>
						`;

					</script>
					";
					$count++;
			};

			echo "
			<script>
				tableHTML+= `
					</tbody>
				</table>
				`;
				$('.tableContent').append(tableHTML);
			</script>
			";


		}


 ?>
