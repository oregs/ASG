<?php require_once 'components/authenticate.php'; ?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>  
<html lang = "eng">
	<head>
		<title>ASG System</title>
		<meta charset = "utf-8" />
		<meta name = "viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.dataTables.css" />
	</head>

<style>
	th {
		text-align: center;
	}
	tr {
		text-align: center;
	}
</style>

<body style = "background-color:#d3d3d3;">
<?php include 'controllers/form/navigation.php'; ?>
<div class = "col-lg-10 well col-sm-offset-1">
	<div id="wrapper" class="wrapper" style = "margin-top:30px;">
		<div class = "alert alert-info" style="text-align:center; font-size:20px;">Result / Assignment Archive</div>
			<button id = "show_submission" type = "button" style = "display:none;" class = "btn btn-success"><span class = "glyphicon glyphicon-circle-arrow-left"></span> Back</button><br/>
					<div id = "submission_table">
						<table id = "table" class="table table-bordered table-striped">
							<thead class = "alert-success">
								<tr>
									<th>Matric No.</th>
									<th>Full Name</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$q_submission = $db->query("SELECT a.course_code, s.matricNum, a.submission_date, a.ass_details, s.student_lastname, s.student_firstname, a.student_id FROM assignmentsubmission a, courseassign e, assignmentdetail d, course c, student s WHERE a.course_code=c.courseCode AND a.student_id=s.id AND e.course=c.courseID GROUP BY a.student_id ORDER BY a.course_code");
									while ($row = $q_submission->fetch_assoc()) {
										$name = $row['student_lastname'].' '.$row['student_firstname'];
								?>
								<tr>
									<td><?php echo $row['matricNum']; ?></td>
									<td><?php echo $name ?></td>
									<td><a href="assignment_history.php?s_id=<?= $row['student_id']; ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-search"></span> view Submission</a></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
	</div>
</div>
</body>
<script src = "../js/sidebar.js"></script>
<script src = "../js/jquery.dataTables.js"></script>
<script>
	$(document).ready(function(){
		$('#table').DataTable({
			"order":[]
		});
	});
</script>