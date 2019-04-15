<?php require_once 'valid.php'; ?>
<!DOCTYPE html>
	<body style = "background-color:#F8F8F8;">
<div class = "container-fluid">
<div class = "col-lg-12">
		<div class="field-wrap">
			<label>Level:<span class="req"></span></label>
         	<select name="level" id="level">
            	<option value = "" selected = "selected" disabled = "disabled">Select your Level</option>
				<?php 
					$sql = mysqli_query($db, "SELECT * FROM level ORDER BY level_code  ASC");
					while ($row = $sql->fetch_assoc()){
				
					echo '<option value="'.$row["levelID"].'">'.$row["level_code"].'</option>';
				}
				?>
				</select>
		</div>
<div class = "col-lg-1"></div>
						<table id="course_data" class ="table table-bordered table-striped">
							<thead class ="alert-success">
								<tr>
									<th>SN</th>
									<th>Course Code</th>
									<th>Course name</th>
									<th>course Unit</th>
									<th>Action</th>
								</tr>
							</thead>
							
						</table>
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

	
<script src = "js/popper.min.js"></script>
<script src = "js/sweetalert.js"></script>
<script>

$(document).ready(function(){

	load_data();
	
	 function load_data(is_level)
	 {
	 	var dataTable = $('#course_data').DataTable({
	 	"processing": true,
	 	"serverSide": true,
	 	"order":[],
	 	"ajax":{
	 		url:"coursereg.php",
	 		type:"POST",
	 		data:{is_level:is_level}
	 	},
	 	"columsDefs":[
	 			{
	 				"targets":[2],
	 				"orderable":false,
	 			},
	 		],
	 	
	 	});
	}

	$(document).on('change', '#level', function(){
		var level = $(this).val();
		$('#course_data').DataTable().destroy();
		if(level != '')
		{
			load_data(level);
		}
		else
		{
			load_data();
		}
	});

	$(document).on('click', '#registered', function(){
		var courseID = $(this).val();
		
		$.ajax({
			url:"components/course_registration.php",
			type:"POST",
			data:{register:"register", courseID:courseID},
			success:function(response){
				if(response == "success"){
					swal({
		                title: "Registration Successful!!!",
		                icon: "success",
		                button: "ok",
		          	});
				}
				else{
					swal({
		                title: "Register already!!!",
		                icon: "warning",
		                button: "ok",
		          	});
				}
			}
		});
	});

});
</script>	
</body>