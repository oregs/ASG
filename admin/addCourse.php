<?php require_once 'components/authenticate.php'; ?>
<!DOCTYPE html>
<?php include 'controllers/base/head.php' ?>

<html lang = "eng">
	<head>
		<title>ASG System</title>
		<meta charset = "utf-8" />
		<meta name="viewport" content = "width=device-width, initial-scale=1" />
		<link rel="stylesheet" type="text/css" href="../css/jquery.dataTables.css"/>
	</head>

<style>
.jumbotron h1 {
  font-size: 40px;
}
</style>

	<body style = "background-color:#d3d3d3;">
		<?php include 'controllers/form/navigation.php'; ?>
<div class = "col-lg-10 well col-sm-offset-1">
	<div id="wrapper" class="wrapper" style = "margin-top:30px;">
		<div class = "alert alert-info" style="text-align:center; font-size:20px;">Insertion/Course</div>
			<div class = "col-lg-1"></div>
					<div class="table_responsive">
						<div align="right">
							<button type="button" name="add" id="add" class="btn btn-info">Add</button>
						</div>
						<br />
						<div id="alert_message"></div>
						<table id="course_data" class ="table table-bordered table-striped">
							<thead class ="alert-success">
								<tr>
									<th>Course Code</th>
									<th>Course name</th>
									<th>Course Unit</th>
									<th>Level</th>
									<th>Action</th>
								</tr>
							</thead>
							
						</table>
					</div>
			</div>
</div>
		<br />
		<br />
		<br />
	</body>
	<script src = "../js/jquery.dataTables.js"></script>

	<script type="text/javascript">

$(document).ready(function(){

	fetch_data();
	
	 function fetch_data()
	 {
	 	var dataTable = $('#course_data').DataTable({
	 	"processing": true,
	 	"serverSide": true,
	 	"order":[],
	 	"ajax":{
	 		url:"components/course_reg.php",
	 		type:"POST"
	 	}

	 	});
	}

	$('#add').click(function(){
		var html = '<tr>';
		html += '<td contenteditable id="data1"></td>';
		html += '<td contenteditable id="data2"></td>';
		html += '<td contenteditable id="data3"></td>';
		html += '<td contenteditable id="data4"><select name="level" id="level"><option value="" selected="selected" disabled="disabled">Select an option</option><?php
			$q_course = $db->query("SELECT * FROM level");
			while($row=$q_course->fetch_assoc()){ echo '<option value="'.$row["levelID"].'">'.$row["level_code"].'</option>'; }?></select></td>';
		html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
		html += '</tr>';
		$('#course_data tbody').prepend(html);
	});

	$(document).on('click', '#insert', function(){
		var courseCode = $('#data1').text();
		var courseName = $('#data2').text();
		var courseUnit = $('#data3').text();
		var level = $('#level').val();
		if(courseCode != '' && courseName != '' && courseUnit != '' && level != '')
		{
			$.ajax({
				url: "components/insert.php",
				method: "POST",
				data:{courseCode:courseCode, courseName:courseName, courseUnit:courseUnit, level:level},
				success:function(data)
				{
					$('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
					$('#course_data').DataTable().destroy();
						fetch_data();
				}
			});
			setInterval(function(){
				$('#alert_message').html('');
			}, 5000);
		}
		else
		{
			alert("Both Fields is required");
		}
	});

	$(document).on("blur", ".update", function(){
		var courseID = $(this).data("id");
		var column_name = $(this).data("column");
		var value = $(this).text();
		$.ajax({
			url:"components/update.php",
			method:"POST",
			data:{courseID:courseID, column_name:column_name, value:value},
			success:function(data)
			{
				$('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
				$('#course_data').DataTable().destroy();
				fetch_data();
			}
		});
		setInterval(function(){
				$('#alert_message').html('');
			}, 5000);
	});

	$(document).on('click', '.delete', function(){
		var courseID = $(this).attr("id");
		if(confirm("Are you sure you want to remove this?"))
		{
			$.ajax({
				url:"components/delete.php",
				method:"POST",
				data:{courseID:courseID},
				success:function(data)
				{
					$('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
					$('#course_data').DataTable().destroy();
					fetch_data();
				}
			});
			setInterval(function(){
				$('#alert_message').html('');
			}, 5000);
		}
	});
});
</script>	

</html>
