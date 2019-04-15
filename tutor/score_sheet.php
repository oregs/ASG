<?php
include 'components/authenticate.php';
 ?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?> 
<html lang = "eng">
	<head>
		<title>ASG System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "../css/datatable_tableexport.css" />
		 
	</head>
	<body style = "background-color:#F8F8F8;">
			<!-- Navigation Bar -->
	        <?php include 'navigation.php'; ?>
	     
		<div class = "container-fluid">
			<?php include 'sidebar.php'; ?>	
		<div class = "col-lg-10 well" style="margin-top:60px;">
			<div class="content">
				<!-- Grading information -->
		<div class = "alert alert-info">Score Sheet / Result</div>
			<div class = "col-lg-1"></div>
					<div class="table_responsive">
						<!-- <div align="right">
							<button type="button" name="add" id="add" class="btn btn-info">Add</button>
						</div> -->
						<br />
						<div id="alert_message"></div>
						<table id="score_data" class ="table table-bordered table-striped">
							<thead class ="alert-success">
								<tr>
									<th>Matric Number</th>
									<th>Course Code</th>
									<th>Assignment 1</th>
									<th>Assignment 2</th>
									<th>Assignment 3</th>
									<th>Assignment 4</th>
									<th>Assignment 5</th>
									<th>Total Score</th>
									<th>Average Score</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$tutor_id = intval($_SESSION['tutor_id']);
									$q_score = $db->query("SELECT a.id, a.count, a.matricNum, a.course_code, a.Assignment_1, a.Assignment_2, a.Assignment_3, a.Assignment_4, a.Assignment_5, sum(ifnull(Assignment_1, 0) + ifnull(Assignment_2, 0) + ifnull(Assignment_3, 0) + ifnull(Assignment_4, 0) + ifnull(Assignment_5, 0)) as total FROM assignmentresult a, courseassign e, course c WHERE tutor_id=$tutor_id AND a.course_code=c.courseCode AND e.course=c.courseID GROUP BY id");
									while ($row = $q_score->fetch_assoc()) { $count = $row['count']; ?> 
								<tr>
									<td><?php echo $row['matricNum']; ?></td>
									<td><?php echo $row['course_code']; ?></td>
									<td><div contenteditable class="update" data-id="<?php echo $row["id"];?>" data-column="Assignment_1"><?php echo $row["Assignment_1"]; ?></div></td>
									<td><div contenteditable class="update" data-id="<?php echo $row["id"];?>" data-column="Assignment_2"><?php echo $row["Assignment_2"]; ?></div></td>
									<td><div contenteditable class="update" data-id="<?php echo $row["id"];?>" data-column="Assignment_3"><?php echo $row["Assignment_3"]; ?></div></td>
									<td><div contenteditable class="update" data-id="<?php echo $row["id"];?>" data-column="Assignment_4"><?php echo $row["Assignment_4"]; ?></div></td>
									<td><div contenteditable class="update" data-id="<?php echo $row["id"];?>" data-column="Assignment_5"><?php echo $row["Assignment_5"]; ?></div></td>
									<td><?php echo $row["total"]; ?></td>
									<td><?php echo round($row["total"]/$count, 2); ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
		</div>
	</div>
			
	</div>




		<br />
		<br />
		<br />
		<!-- <nav class = "navbar navbar-default navbar-fixed-bottom">
			<div class = "container-fluid">
				<label class = "navbar-text pull-right">Assignment Submission & Grading System &copy; All rights reserved 2018</label>
			</div>
		</nav>
 -->
	</body>
	<script src = "../js/login.js"></script>
	<script src = "../js/sidebar.js"></script>
	<script src = "../js/datatable_tableexport.js"></script>

<script type="text/javascript">

$(document).ready(function(){
	$('#score_data').DataTable({
		dom: 'lBfrtip',
		buttons: [
			'excel', 'csv', 'pdf', 'copy'
		],
		"lengthMenu":[ [10, 25, 50, -1], [10, 25, 50, "All"] ]
	});

	$(document).on("blur", ".update", function(){
		var id = $(this).data("id");
		var column_name = $(this).data("column");
		var value = $(this).text();
		$.ajax({
			url:"components/update-score.php",
			method:"POST",
			data:{id:id, column_name:column_name, value:value},
			success:function(data)
			{
				$('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
				$('#score_data').DataTable().destroy();
			}
		})
		setInterval(function(){
				$('#alert_message').html('');
			}, 5000);
	});
});
</script>	

</html>
