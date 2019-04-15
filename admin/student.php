<?php 
require 'components/authenticate.php';
?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>
<html lang = "eng">
	<head>
		<title>ASG System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content = "width=device-width, initial-scale=1" />
		<link rel = "stylesheet" type = "text/css" href = "../css/jquery.lwMultiSelect.css" />
		<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css"/>
	</head>
	<style>
.jumbotron h1 {
  font-size: 40px;
}
</style>
	<body style = "background-color:#d3d3d3;">
		<?php include 'controllers/form/navigation.php'; ?>
<div class = "col-lg-10 well" style="background: white; position:relative; left:8%;">
	<div id="wrapper" class="wrapper" style = "margin-top:30px;">
		<div class = "alert alert-info" style="text-align:center; font-size:20px;">Accounts/Student</div>
			<div class = "col-lg-1"></div>
					<div class="table_responsive">
						<div align="right">
							<button id = "add_student" type = "button" class = "btn btn-primary"><span class = "glyphicon glyphicon-plus"></span> Add new</button>
							<button id = "show_student" type = "button" style = "display:none;" class = "btn btn-success"><span class = "glyphicon glyphicon-circle-arrow-left"></span> Back</button>
						</div>
						<br />
						<div id="alert_message"></div>
					<div id = "student_table">
						<table id="student_data" class ="table table-bordered table-striped">
							<thead class ="alert-success">
								<tr>
									<th>SN</th>
									<th>Matric Number</th>
									<th>Full Name</th>
									<th>Level</th>
									<th>Phone</th>
									<th>Email</th>
									<th>Assigned Courses</th>
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
					</div>
			</div>
					<div id="student_form" style = "display:none;">
						<div class = "col-lg-3"></div>
						<div class = "col-lg-6">
							<form method = "POST" action = "components/save_student_query.php" enctype = "multipart/form-data">
								<div class = "form-group">	
									<label>Firstname:</label>
									<input type = "text" name = "firstname" required = "required" class = "form-control" />
								</div>		
								<div class = "form-group">	
									<label>Lastname:</label>
									<input type = "text" required = "required" name = "lastname" class = "form-control" />
								</div>
								<div class = "form-group">
									<label>Matric Number:</label>
									<input type = "text" required = "required" name = "matricNum" class = "form-control" />
								</div>
								<div class = "form-group">
									<label>Level:</label>
									<select name="level" id="level" required="required" class="form-control" required="required">
										<option value="" disabled="disabled" selected="selected">Select Level</option>
									<?php
										$q_level = $db->query("SELECT * FROM level");
										while ($r_level=$q_level->fetch_assoc()) {
											echo '<option value="'.$r_level['levelID'].'">'.$r_level['level_code'].'</option>';
										}
									?>
									</select>
								</div>	
								<div class = "form-group">	
									<label>Phone:</label>
									<input type = "text" required = "required" name = "phone" class = "form-control" />
								</div>
								<div class = "form-group">	
									<label>Email:</label>
									<input type = "text" required = "required" name = "email" class = "form-control" />
								</div>
								
								<div class = "form-group">	
									<label>Password:</label>
									<input type = "password" maxlength = "12" name = "password" required = "required" class = "form-control" />
								</div>	
								
								<div class = "form-group">	
									<button class = "btn btn-primary" name="save_student"><span class = "glyphicon glyphicon-save"></span> Submit</button>
								</div>
							</form>		
						</div>	
					</div>
</div>
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">
				<div id="content-data"></div>
		</div>

<script src = "../js/popper.min.js"></script>
<script src = "../js/sweetalert.js"></script>
<script src="../js/jquery.lwMultiSelect.js"></script>
<script src = "../js/jquery.dataTables.js"></script>
	<!-- <script src="assets/js/bootstrap-multiselect.js"></script> -->

	<script type="text/javascript">

$(document).ready(function(){

	fetch_data();
	
	 function fetch_data()
	 {
	 	var dataTable = $('#student_data').DataTable({
	 	"processing": true,
	 	"serverSide": true,
	 	"order":[],
	 	"ajax":{
	 		url:"components/student_query.php",
	 		type:"POST"
	 	}

	 	});
	}
});
</script>
<!-- script js for get view data -->
<script>
	$(document).on('click', '#getView', function(e){
		e.preventDefault();
		var per_student = $(this).data('id');
		$('#content-data').html('');
		$.ajax({
			url:'controllers/form/course_enroll.php',
			type:'POST',
			data:'id='+per_student,
			dataType:'html'
		}).done(function(data){
			$('#content-data').html('');
			$('#content-data').html(data);
		})
	});
</script>	
<!-- script js for get edit data -->
<script>
	$(document).on('click', '#getEdit', function(e){
		e.preventDefault();
		var per_id = $(this).data('id');
		$('#content-data').html('');
		$.ajax({
			url:'controllers/form/edit_student_profile_form.php',
			type:'POST',
			data:'id='+per_id,
			dataType:'html'
		}).done(function(data){
			$('#content-data').html('');
			$('#content-data').html(data);
		})
	});
</script>
<script>
		$(document).ready(function(){
			$('#add_student').click(function(){
				$(this).hide();
				$('#show_student').show();
				$('#student_table').slideUp();
				$('#student_form').slideDown();
				$('#show_student').click(function(){
					$(this).hide();
					$('#add_student').show();
					$('#student_table').slideDown();
					$('#student_form').slideUp();
				});
			});
		});
	</script>
	</body>
</html>
<?php
//Delete
if(isset($_GET['delete'])){
	$id = $_GET['delete'];
	$sqldelete = "DELETE FROM student WHERE id=$id";
	$result_delete = mysqli_query($db, $sqldelete);
	if($result_delete){
		echo '<script>window.location.href="student.php"</script>';
	}
	else{
	echo '<script>alert("Data not deleted, Ensure to delete every data related to this User")</script>';	
	}
}
?>