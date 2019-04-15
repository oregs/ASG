<?php require'connect.php'; ?>
<?php require_once 'valid.php'; ?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>

<body style = "background-color:#F8F8F8;">

		<!-- Navigation Bar -->
		<?php include 'navigation.php'; ?>

<div class = "container-fluid">
	<!-- Side Bar -->
	<?php include 'sidebar.php' ?>	
	<!-- Connection to the Database -->
	<?php require_once'connect.php'; ?>
	<div class = "col-lg-10 well" style = "margin-top:60px;">
		<div class = "alert alert-info">Course Enrolled / Course Registration</div>

    <h4 id="details">For enrollment of course<a id="register" class = "btn btn-primary"><span class="glyphicon glyphicon-arrow-right">&nbsp;</span>Click Here</a></h4>
   
		<a href="view_enroll_course.php" id = "show_course" type="button" style = "display:none;" class = "btn btn-success"><span class = "glyphicon glyphicon-circle-arrow-left"></span> Back</a><br><br>
					<br />
					<div id = "enroll_table">
						<table id = "table" class="table table-bordered table-striped">
							<thead class = "alert-success">
								<tr>
									<th>Course Code</th>
									<th>Course name</th>
									<th>course Unit</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									// die(var_dump($student));
									$q_course = $db->query("SELECT * FROM courseenroll e, course c WHERE e.student=$student AND e.course=c.courseID");
									while ($row = $q_course->fetch_assoc()) {
										
								?>
								<tr>
									<td><?php echo $row['courseCode']; ?></td>
									<td><?php echo $row['courseName']; ?></td>
									<td><?php echo $row['courseUnit']; ?></td>				
									<td> <button type="button" name="remove" class="btn btn-danger btn-xs remove" value="<?php echo $row['id']; ?>"><span class="glyphicon glyphicon-trash"></span> Delete</button></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div id ="course_registration"></div>

	</div>
</div>	
<br />
<br />
<br />
<nav class = "navbar navbar-default navbar-fixed-bottom">
	<div class = "container-fluid">
		<label class = "navbar-text pull-right">Assignment Submission & Grading System &copy; All rights reserved 2018</label>
	</div>
</nav>


<script src = "js/sidebar.js"></script>
<script src = "js/jquery.dataTables.js"></script>
<script type = "text/javascript">
$(document).ready(function(){
	$('#table').DataTable();
});

$(document).ready(function(){
	$('#register').click(function(){
		$(this).hide();
		$('#details').hide();
		$('#show_course').show();
		$('#show_course').click(function(){
			$(this).hide();
			$('#register').show();
			$('#details').show();
			$('#course_registration').empty();
			$('#enroll_table').show();
		});
		$('#enroll_table').fadeOut();
		$('#course_registration').load('enroll.php');
	});

	$result = $('<center><label>Deleting...</label></center>');
    $('.remove').click(function(){
                $enrolledID = $(this).attr('value');
            if(confirm("Are you sure you want to remove this?"))
            {
                $(this).parents('td').empty().append($result);
                $('.remove').attr('disabled', 'disabled');
                setTimeout(function(){
                    window.location = 'components/delete_enrolled_course.php?enrolledID=' + $enrolledID;
                }, 1000);
            }
        });
});
</script>
</body>