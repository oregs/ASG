<?php
require_once '../../components/connect.php';
session_start();
$_SESSION['id'] = $_REQUEST['id'];
$query_course = $db->query("SELECT * FROM courseenroll INNER JOIN course ON course.courseID=courseenroll.course WHERE student=".$_REQUEST['id']."");
$row = $query_course->num_rows;

$get_courses = $db->query("SELECT * FROM course");
?>
<div class="modal-content">
	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Course Enroll Information</h4>
			</div>
			<div class="modal-body">
				<div class="box-body">
					<form method="POST" class="form-horizontal" id='course_data'>
						<div class="row">
						    <div class = "col-md-5 col-sm-offset-2" align="center">
						     <label>Assigned Course</label><br />
						     <select id="course" name="course[]" class="form-control" multiple>
						     	<?php
						     		while ($r=$get_courses->fetch_assoc()) 
						     		{
						     			echo '<option value="'.$r['courseID'].'">'.$r['courseCode'].'-'.$r['courseName'].'</option>';
						     		}
						     	?>
						     </select>
						   </div>
						</div><br>
						<div class="row">
							<div class="col-sm-12" align="center">
								<button type="submit" name="add" id="add" class="btn btn-primary">Add</button>
							</div>
						</div><br>
					</form>	
							<div id="alert_message2"></div>
							<div id = "assign_table">
						<table id="tutor_data" class ="table table-bordered table-striped">
							<thead class ="alert-success">
								<tr>
									<th>Course Name</th>
									<th>Course Code</th>
									<th>Action</th>
								</tr>
								<tbody>
						<?php
						if($row > 0)
						{
							while ($result=$query_course->fetch_assoc()) 
							{
								
						?>
							<tr>
								<td><?php echo $result['courseName'] ?></td>
								<td><?php echo $result['courseCode'] ?></td>
								<td> <button type="button" name="remove" value="<?php echo $result['id'] ?>" class="btn btn-danger btn-xs remove" value=""><span class="glyphicon glyphicon-trash"></span> Delete</button></td>
							</tr>
						<?php }} ?>

								</tbody>
							</thead>
						</table>
					</div>					
				</div>
			</div>
			<div class="modal-footer">
				<a href="../admin/student.php"><button type="button" class="btn btn-danger">Cancel</button></a>
			</div>
</div>
<script>
$(document).ready(function(){
	$('#course').lwMultiSelect();
	$('#course_data').on('submit', function(){
		$('#course').val();
		var form_data = $(this).serialize();
		$.ajax({
			url:"components/save_courseenroll_query.php",
			method:"POST",
			data:form_data,
			success:function(data){
				if(data)
				{
				
					$('#course').data('plugin_lwMultiSelect').updateList();
					$('#course').data('plugin_lwMultiSelect').removeAll();
					
					alert('Data Inserted');
				}
			}
		});
	});
	$result = $('<center><label>Deleting...</label></center>');
	$('.remove').click(function(){
				$enrollID = $(this).attr('value');
			if(confirm("Are you sure you want to remove this?"))
			{
				$(this).parents('td').empty().append($result);
				$('.remove').attr('disabled', 'disabled');
				setTimeout(function(){
					window.location = 'components/delete_enroll_course.php?enrollID=' + $enrollID;
				}, 1000);
			}
		});
});
</script>